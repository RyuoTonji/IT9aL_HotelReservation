<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Room;
use App\Models\RoomSizeType;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceAdded;

class BookingController extends Controller {
  public function AppendBooking(Request $request) {
    // if (Booking::where('UserID', Auth::id())->where('BookingStatus', 'Pending')->exists()) {
    //   return back()->with('toast_error', 'You already have a pending booking.');
    // }

    $roomSize = RoomSizeType::where('RoomSizeName', $request->RoomSize)->firstOrFail();
    $maxGuests = $roomSize->RoomCapacity;

    $request->validate([
      'CheckInDate' => 'required|date|after_or_equal:today',
      'CheckOutDate' => 'required|date|after:CheckInDate',
      'RoomType' => 'required|string|in:Standard,Executive,Deluxe',
      'RoomSize' => 'required|string|in:Single,Double,Family',
      'NumberOfGuests' => "required|integer|min:1|max:$maxGuests",
      'Services' => 'nullable|array',
      'Services.*' => 'integer|exists:Services,ID|distinct',
    ]);

    // dd($request->all());

    DB::beginTransaction();
    try {
      $room = Room::where('RoomTypeName', $request->RoomType)->firstOrFail();
      $roomSize = RoomSizeType::where('RoomSizeName', $request->RoomSize)->firstOrFail();
      $totalAmount = $room->RoomPrice + ($roomSize->PricePerPerson * $request->NumberOfGuests);

      if ($request->filled('Services')) {
        $services = Service::whereIn('ID', $request->Services)->get();
        $totalAmount += $services->sum('ServicePrice');
      }

      // dd($room, $roomSize, $totalAmount, $services);

      $booking = new Booking();
      $booking->UserID = Auth::id();
      $booking->CheckInDate = $request->CheckInDate;
      $booking->CheckOutDate = $request->CheckOutDate;
      $booking->RoomTypeID = Room::where('RoomTypeName', $request->RoomType)->first()->ID;
      $booking->RoomSizeID = RoomSizeType::where('RoomSizeName', $request->RoomSize)->first()->ID;
      $booking->NumberOfGuests = $request->NumberOfGuests;
      // Set other fields as necessary
      $booking->save();

      // $bookingDetail = BookingDetail::create([
      //   'BookingID' => $booking->ID,
      //   'UserID' => Auth::id(),
      // ]);

      if ($request->filled('Services')) {
        foreach ($request->Services as $serviceID) {
          ServiceAdded::create([
            'BookingDetailID' => $booking->ID,
            'ServiceID' => $serviceID,
          ]);
        }
      }

      DB::commit();
      return redirect()->route('booking.details')->with(
        [
          'BookingID' => $booking->ID,
          // 'BookingDetailID' => $bookingDetail->ID,
          'TotalAmount' => $totalAmount,
        ]
      );
    } catch (\Exception $e) {
      DB::rollBack();
      return back()->with('toast_error', 'Failed to save booking: ' . $e->getMessage());
    }
    // return back()->with('toast_success', 'Booking successful!');
  }

  public function CancelBooking(Request $request, $bookingID) {
    $this->middleware('auth');

    DB::beginTransaction();
    try {
      $booking = Booking::where('ID', $bookingID)
        ->where('UserID', Auth::id())
        ->firstOrFail();

      // Delete related records
      Booking::where('ID', $bookingID)->delete();
      ServiceAdded::where('BookingDetailID', $bookingID)->delete();
      $booking->delete();

      DB::commit();
      return redirect()->route('booking')->with('toast_success', 'Booking cancelled successfully!');
    } catch (\Exception $e) {
      DB::rollBack();
      // abort(0, $e->getMessage());
      return back()->with('toast_error', 'Failed to cancel booking: ' . $e->getMessage());
    }
  }
}
