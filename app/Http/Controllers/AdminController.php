<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\AssignedRoom;
use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;

class AdminController extends Controller {

  public function __construct() {
    $this->middleware('RestrictByRole:Admin');
  }

  public function dashboard() {
    return view('admin.dashboard');
  }

  public function masterDashboard() {
    return view('admin.master_dashboard');
  }

  public function frontDesk() {
    return view('admin.frontdesk')->with('Reservations');
  }

  public function guest(Request $request) {
    $currentDate = Carbon::today();
    $search = $request->input('search');
    $sort = $request->input('sort', 'ID');
    $direction = $request->input('direction', 'asc');
    $perPage = 10;

    $validSortColumns = ['ID', 'UserName', 'RoomTypeName', 'RoomSizeName', 'HasServices', 'CheckInDate', 'CheckOutDate', 'TotalAmount', 'RoomName'];
    if (!in_array($sort, $validSortColumns)) {
      $sort = 'ID';
    }

    $baseQuery = Booking::with(['roomType', 'roomSize', 'servicesAdded', 'costDetails', 'assignedRooms.room'])
      ->leftJoin('users', 'BookingDetails.UserID', '=', 'users.id')
      ->leftJoin('RoomTypes', 'BookingDetails.RoomTypeID', '=', 'RoomTypes.ID')
      ->leftJoin('RoomSizes', 'BookingDetails.RoomSizeID', '=', 'RoomSizes.ID')
      ->leftJoin('BookingCostDetails', 'BookingDetails.ID', '=', 'BookingCostDetails.BookingDetailID')
      ->leftJoin('AssignedRooms', 'BookingDetails.ID', '=', 'AssignedRooms.BookingDetailID')
      ->leftJoin('Rooms', 'AssignedRooms.RoomID', '=', 'Rooms.ID')
      ->leftJoin('PaymentInfos', 'BookingDetails.ID', '=', 'PaymentInfos.BookingDetailID')
      ->select(
        'BookingDetails.ID',
        'BookingDetails.CheckInDate',
        'BookingDetails.CheckOutDate',
        'BookingDetails.BookingStatus',
        'users.name as UserName',
        'RoomTypes.RoomTypeName',
        'RoomSizes.RoomSizeName',
        'BookingCostDetails.TotalAmount',
        \DB::raw('IFNULL(Rooms.RoomName, "") as RoomName'),
        \DB::raw('EXISTS (SELECT 1 FROM ServicesAdded WHERE ServicesAdded.BookingDetailID = BookingDetails.ID) as HasServices'),
        \DB::raw('COALESCE(SUM(CASE WHEN PaymentInfos.PaymentStatus = "Verified" THEN PaymentInfos.TotalAmount ELSE 0 END), 0) as AmountPaid')
      )
      ->groupBy(
        'BookingDetails.ID',
        'BookingDetails.CheckInDate',
        'BookingDetails.CheckOutDate',
        'BookingDetails.BookingStatus',
        'users.name',
        'RoomTypes.RoomTypeName',
        'RoomSizes.RoomSizeName',
        'BookingCostDetails.TotalAmount',
        'Rooms.RoomName'
      );

    if ($search) {
      $baseQuery->where(function ($q) use ($search) {
        $q->where('BookingDetails.ID', 'like', '%' . $search . '%')
          ->orWhere('users.name', 'like', '%' . $search . '%')
          ->orWhere('RoomTypes.RoomTypeName', 'like', '%' . $search . '%')
          ->orWhere('RoomSizes.RoomSizeName', 'like', '%' . $search . '%')
          ->orWhere('Rooms.RoomName', 'like', '%' . $search . '%');
      });
    }

    if ($sort === 'UserName') {
      $baseQuery->orderBy('users.name', $direction);
    } elseif ($sort === 'RoomTypeName') {
      $baseQuery->orderBy('RoomTypes.RoomTypeName', $direction);
    } elseif ($sort === 'RoomSizeName') {
      $baseQuery->orderBy('RoomSizes.RoomSizeName', $direction);
    } elseif ($sort === 'HasServices') {
      $baseQuery->orderBy('HasServices', $direction);
    } elseif ($sort === 'RoomName') {
      $baseQuery->orderByRaw("CAST(SUBSTRING_INDEX(Rooms.RoomName, '-', 1) AS UNSIGNED) $direction")
        ->orderByRaw("CAST(SUBSTRING_INDEX(Rooms.RoomName, '-', -1) AS UNSIGNED) $direction");
    } else {
      $baseQuery->orderBy('BookingDetails.' . $sort, $direction);
    }

    $pendingQuery = clone $baseQuery;
    $pendingReservations = $pendingQuery->where('BookingDetails.BookingStatus', 'Pending')
      ->whereExists(function ($q) {
        $q->select(\DB::raw(1))
          ->from('PaymentInfos')
          ->whereColumn('PaymentInfos.BookingDetailID', 'BookingDetails.ID')
          ->whereIn('PaymentInfos.PaymentStatus', ['Submitted', 'Pending']);
      })
      ->paginate($perPage, ['*'], 'pending_page')
      ->appends(['search' => $search, 'sort' => $sort, 'direction' => $direction]);

    // dd($pendingQuery);

    $confirmedQuery = clone $baseQuery;
    $confirmedReservations = $confirmedQuery->where('BookingDetails.BookingStatus', 'Confirmed')
      ->paginate($perPage, ['*'], 'confirmed_page')
      ->appends(['search' => $search, 'sort' => $sort, 'direction' => $direction]);

    $ongoingQuery = clone $baseQuery;
    $ongoingReservations = $ongoingQuery->where('BookingDetails.BookingStatus', 'Ongoing')
      ->paginate($perPage, ['*'], 'ongoing_page')
      ->appends(['search' => $search, 'sort' => $sort, 'direction' => $direction]);

    $endedQuery = clone $baseQuery;
    $endedReservations = $endedQuery->where('BookingDetails.BookingStatus', 'Ended')
      ->paginate($perPage, ['*'], 'ended_page')
      ->appends(['search' => $search, 'sort' => $sort, 'direction' => $direction]);

    $cancelledQuery = clone $baseQuery;
    $cancelledReservations = $cancelledQuery->where('BookingDetails.BookingStatus', 'Cancelled')
      ->paginate($perPage, ['*'], 'cancelled_page')
      ->appends(['search' => $search, 'sort' => $sort, 'direction' => $direction]);

    return view('admin.guest', [
      'pendingReservations' => $pendingReservations,
      'confirmedReservations' => $confirmedReservations,
      'ongoingReservations' => $ongoingReservations,
      'endedReservations' => $endedReservations,
      'cancelledReservations' => $cancelledReservations,
      'search' => $search,
      'sort' => $sort,
      'direction' => $direction,
    ]);
  }

  public function rooms(Request $request) {
    // Current date for checking active bookings
    // Current date for checking active bookings
    $currentDate = Carbon::today();

    // Get search term, sort column, and sort direction
    $search = $request->input('search');
    $sort = $request->input('sort', 'RoomName');
    $direction = $request->input('direction', 'asc');
    $perPage = 10;

    // Validate sort column
    $validSortColumns = ['RoomName', 'RoomTypeName', 'RoomSizeName', 'Floor', 'status', 'Occupant'];
    if (!in_array($sort, $validSortColumns)) {
      $sort = 'RoomName';
    }

    \DB::enableQueryLog();
    // Modified: Simplified all rooms query
    $query = Room::with(['roomType', 'roomSize'])
      ->leftJoin('RoomTypes', 'Rooms.RoomTypeID', '=', 'RoomTypes.ID')
      ->leftJoin('RoomSizes', 'Rooms.RoomSizeID', '=', 'RoomSizes.ID')
      ->select(
        'Rooms.ID',
        'Rooms.RoomName',
        'Rooms.Floor',
        'RoomTypes.RoomTypeName',
        'RoomSizes.RoomSizeName'
      );

    // Apply search filter
    if ($search) {
      $query->where(function ($q) use ($search) {
        $q->where('Rooms.RoomName', 'like', '%' . $search . '%')
          ->orWhere('RoomTypes.RoomTypeName', 'like', '%' . $search . '%')
          ->orWhere('RoomSizes.RoomSizeName', 'like', '%' . $search . '%')
          ->orWhere('Rooms.Floor', 'like', '%' . $search . '%');
      });
    }

    // Apply sorting
    if ($sort === 'RoomName') {
      $query->orderByRaw("CAST(SUBSTRING_INDEX(RoomName, '-', 1) AS UNSIGNED) $direction")
        ->orderByRaw("CAST(SUBSTRING_INDEX(RoomName, '-', -1) AS UNSIGNED) $direction");
    } elseif ($sort === 'RoomTypeName') {
      $query->orderBy('RoomTypes.RoomTypeName', $direction);
    } elseif ($sort === 'RoomSizeName') {
      $query->orderBy('RoomSizes.RoomSizeName', $direction);
    } else {
      $query->orderBy('Rooms.' . $sort, $direction);
    }

    // All rooms
    $allRooms = $query->paginate($perPage, ['*'], 'all_page')->appends([
      'search' => $search,
      'sort' => $sort,
      'direction' => $direction,
    ]);

    // Modified: Fixed status and occupant logic for all rooms
    $allRooms->getCollection()->transform(function ($room) use ($currentDate) {
      $booking = AssignedRoom::where('RoomID', $room->ID)
        ->join('BookingDetails', 'AssignedRooms.BookingDetailID', '=', 'BookingDetails.ID')
        ->leftJoin('users', 'BookingDetails.UserID', '=', 'users.id')
        ->whereIn('BookingDetails.BookingStatus', ['Confirmed', 'Ongoing'])
        ->where('BookingDetails.CheckInDate', '<=', $currentDate->endOfDay())
        ->where('BookingDetails.CheckOutDate', '>=', $currentDate->startOfDay())
        ->select(
          'BookingDetails.BookingStatus',
          \DB::raw('IFNULL(users.name, "") as Occupant')
        )
        ->first();

      $room->status = $booking ? ($booking->BookingStatus === 'Confirmed' ? 'Pending' : 'Occupied') : 'Available';
      $room->Occupant = $booking ? $booking->Occupant : '';
      return $room;
    });
    // End Modified

    \Log::info('All Rooms Query', \DB::getQueryLog());
    \DB::disableQueryLog();

    \DB::enableQueryLog();
    // Modified: Fixed available rooms query
    $availableQuery = clone $query;
    $availableRooms = $availableQuery->whereNotIn('Rooms.ID', function ($q) use ($currentDate) {
      $q->select('RoomID')
        ->from('AssignedRooms')
        ->join('BookingDetails', 'AssignedRooms.BookingDetailID', '=', 'BookingDetails.ID')
        ->whereIn('BookingDetails.BookingStatus', ['Confirmed', 'Ongoing'])
        ->where('BookingDetails.CheckInDate', '<=', $currentDate->endOfDay())
        ->where('BookingDetails.CheckOutDate', '>=', $currentDate->startOfDay());
    })->paginate($perPage, ['*'], 'available_page')->appends([
      'search' => $search,
      'sort' => $sort,
      'direction' => $direction,
    ]);
    \Log::info('Available Rooms Query', \DB::getQueryLog());
    \DB::disableQueryLog();

    $availableRooms->getCollection()->transform(function ($room) {
      $room->status = 'Available';
      $room->Occupant = '';
      return $room;
    });
    // End Modified

    \DB::enableQueryLog();
    // Modified: Fixed occupied rooms query
    $occupiedQuery = AssignedRoom::join('Rooms', 'AssignedRooms.RoomID', '=', 'Rooms.ID')
      ->join('BookingDetails', 'AssignedRooms.BookingDetailID', '=', 'BookingDetails.ID')
      ->join('RoomTypes', 'Rooms.RoomTypeID', '=', 'RoomTypes.ID')
      ->join('RoomSizes', 'Rooms.RoomSizeID', '=', 'RoomSizes.ID')
      ->leftJoin('users', 'BookingDetails.UserID', '=', 'users.id')
      ->select(
        'Rooms.ID',
        'Rooms.RoomName',
        'Rooms.Floor',
        'RoomTypes.RoomTypeName',
        'RoomSizes.RoomSizeName',
        \DB::raw('IFNULL(users.name, "") as Occupant'),
        \DB::raw('CASE BookingDetails.BookingStatus
                    WHEN "Confirmed" THEN "Pending"
                    WHEN "Ongoing" THEN "Occupied"
                    ELSE "Unknown"
                  END as status')
      )
      ->whereIn('BookingDetails.BookingStatus', ['Confirmed', 'Ongoing'])
      ->where('BookingDetails.CheckInDate', '<=', $currentDate->endOfDay())
      ->where('BookingDetails.CheckOutDate', '>=', $currentDate->startOfDay());

    \Log::info('Occupied Rooms Query', \DB::getQueryLog());
    \DB::disableQueryLog();
    if ($search) {
      $occupiedQuery->where(function ($q) use ($search) {
        $q->where('Rooms.RoomName', 'like', '%' . $search . '%')
          ->orWhere('RoomTypes.RoomTypeName', 'like', '%' . $search . '%')
          ->orWhere('RoomSizes.RoomSizeName', 'like', '%' . $search . '%')
          ->orWhere('Rooms.Floor', 'like', '%' . $search . '%')
          ->orWhere('users.name', 'like', '%' . $search . '%');
      });
    }

    if ($sort === 'RoomName') {
      $occupiedQuery->orderByRaw("CAST(SUBSTRING_INDEX(Rooms.RoomName, '-', 1) AS UNSIGNED) $direction")
        ->orderByRaw("CAST(SUBSTRING_INDEX(Rooms.RoomName, '-', -1) AS UNSIGNED) $direction");
    } elseif ($sort === 'RoomTypeName') {
      $occupiedQuery->orderBy('RoomTypes.RoomTypeName', $direction);
    } elseif ($sort === 'RoomSizeName') {
      $occupiedQuery->orderBy('RoomSizes.RoomSizeName', $direction);
    } elseif ($sort === 'Occupant') {
      $occupiedQuery->orderBy('Occupant', $direction);
    } elseif ($sort === 'status') {
      $occupiedQuery->orderBy('status', $direction);
    } else {
      $occupiedQuery->orderBy('Rooms.' . $sort, $direction);
    }

    $occupiedRooms = $occupiedQuery->groupBy(
      'Rooms.ID',
      'Rooms.RoomName',
      'Rooms.Floor',
      'RoomTypes.RoomTypeName',
      'RoomSizes.RoomSizeName',
      'users.name',
      'BookingDetails.BookingStatus'
    )->paginate($perPage, ['*'], 'occupied_page')->appends([
      'search' => $search,
      'sort' => $sort,
      'direction' => $direction,
    ]);
    // End Modified

    // dd($allRooms, $availableRooms, $occupiedRooms);

    return view('admin.rooms', [
      'allRooms' => $allRooms,
      'availableRooms' => $availableRooms,
      'occupiedRooms' => $occupiedRooms,
      'search' => $search,
      'sort' => $sort,
      'direction' => $direction,
    ]);
  }

  public function deals() {
    return view('admin.deals');
  }

  public function rate() {
    return view('admin.rate');
  }

  public function createBooking() {
    return view('admin.booking');
  }

  private function AdminCheck() {
    if (!Auth::check()) {
      if (Auth::user()->role !== 'Admin') {
        abort(403, 'Unauthorized action.');
      }
      abort(69420, 'Unauthorized action.');
    }
  }
}
