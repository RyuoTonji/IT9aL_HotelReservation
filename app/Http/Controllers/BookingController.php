<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\RoomSizeType;
use Illuminate\Support\Facades\Auth;
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

    // Assuming you have a Booking model
    $booking = new Booking();
    $booking->UserID = Auth::id();
    $booking->CheckInDate = $request->CheckInDate;
    $booking->CheckOutDate = $request->CheckOutDate;
    $booking->RoomID = Room::where('RoomName', $request->RoomType)->first()->ID;
    $booking->RoomSize = RoomSizeType::where('RoomSizeName', $request->RoomSize)->first()->ID;
    $booking->NumberOfGuests = $request->NumberOfGuests;
    // Set other fields as necessary
    $booking->save();

    if ($request->filled('Services')) {
      foreach ($request->Services as $serviceID) {
        ServiceAdded::create([
          'BookingDetailID' => $booking->ID,
          'ServiceID' => $serviceID,
        ]);
      }
    }

    return back()->with('toast_success', 'Booking successful!');
  }
}
