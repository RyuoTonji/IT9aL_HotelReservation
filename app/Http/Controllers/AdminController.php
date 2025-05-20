<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomSizeType;
use App\Models\Service;
use App\Models\Feedback;
use App\Models\User;
use App\Models\PaymentInfo;
use App\Models\LoyaltyTier;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class AdminController extends Controller {

  public function __construct() {
    $this->middleware('RestrictByRole:Admin');
  }

  public function Dashboard() {
    return view('admin.dashboard', ['title' => 'Dashboard']);

    $todayCheckIn = Booking::whereDate('CheckInDate', Carbon::today())->count();
    $todayCheckOut = Booking::whereDate('CheckOutDate', Carbon::today())->count();
    $totalInHotel = Booking::where('CheckInDate', '<=', Carbon::today())
        ->where('CheckOutDate', '>=', Carbon::today())
        ->count();
    $availableRooms = Room::count() - $totalInHotel;
    $occupiedRooms = $totalInHotel;

    $roomTypes = Room::all();
    $roomStatus = [
        'Occupied' => $occupiedRooms,
        'Clean' => Room::count() - $occupiedRooms, // Placeholder
        'Dirty' => 0,
        'Inspected' => 0,
    ];
    $floorStatus = [
        'Available' => Room::count() - $occupiedRooms,
        'Clean' => Room::count() - $occupiedRooms,
        'Dirty' => 0,
        'Inspected' => 0,
    ];

    $occupancyData = [];
    for ($i = 11; $i >= 0; $i--) {
        $month = Carbon::today()->subMonths($i);
        $occupancyData[$month->format('M Y')] = Booking::whereMonth('CheckInDate', $month->month)
            ->whereYear('CheckInDate', $month->year)
            ->count();
    }

    return view('admin.dashboard', compact(
        'todayCheckIn',
        'todayCheckOut',
        'totalInHotel',
        'availableRooms',
        'occupiedRooms',
        'roomTypes',
        'roomStatus',
        'floorStatus',
        'occupancyData'
    ));
  }

  private function AdminCheck() {
    if (!Auth::check()) {
      if(Auth::user()->role !== 'Admin') {
        abort(403, 'Unauthorized action.');
      }
      abort(69420, 'Unauthorized action.');
    }
  }

  public function FrontDesk()
  {
      $checkIns = Booking::whereDate('CheckInDate', Carbon::today())->with('user', 'roomType', 'roomSize')->get();
      $checkOuts = Booking::whereDate('CheckOutDate', Carbon::today())->with('user', 'roomType', 'roomSize')->get();
      $dueOuts = Booking::whereDate('CheckOutDate', Carbon::today())->with('user', 'roomType', 'roomSize')->get();
      $checkedIns = Booking::where('CheckInDate', '<=', Carbon::today())
          ->where('CheckOutDate', '>=', Carbon::today())
          ->with('user', 'roomType', 'roomSize')
          ->get();

      return view('admin.desk', compact('checkIns', 'checkOuts', 'dueOuts', 'checkedIns'));
  }

  public function Guest()
  {
      $bookings = Booking::with('user', 'roomType', 'roomSize', 'paymentInfo')->latest()->get();
      return view('admin.guest', compact('bookings'));
  }

  public function Rooms()
  {
      $rooms = Room::all();
      $roomSizes = RoomSizeType::all();
      return view('admin.rooms', compact('rooms', 'roomSizes'));
  }

  public function Deals()
  {
      $services = Service::where('ServiceStatus', 'Available')->get();
      $rooms = Room::all();
      return view('admin.deals', compact('services', 'rooms'));
  }

  public function Rate()
  {
      $rooms = Room::all();
      $roomSizes = RoomSizeType::all();
      $loyaltyTiers = LoyaltyTier::all();
      $services = Service::all();
      return view('admin.rate', compact('rooms', 'roomSizes', 'loyaltyTiers', 'services'));
  }

  public function MasterDashboard()
  {
      if (Auth::user()->Username !== 'Black Manager') {
          abort(403, 'Unauthorized');
      }

      $totalUsers = User::count();
      $totalBookings = Booking::count();
      $totalRevenue = PaymentInfo::where('PaymentStatus', 'Completed')->sum('TotalAmount');

      return view('admin.master_dashboard', compact(
          'totalUsers',
          'totalBookings',
          'totalRevenue'
      ));
  }

}
