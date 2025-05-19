<?php

namespace App\Http\Controllers;

use App\Models\BookingDetail;
use App\Models\Room;
use App\Models\Booking;
use App\Models\LoyaltyTier;
use App\Models\Service;
use App\Models\PaymentInfo;
use Illuminate\Support\Facades\Auth;
use App\Models\RoomSizeType;
use App\Models\UserLoyalty;
use Illuminate\Http\Request;

class PageController extends Controller {
  public function home() {
    return view('customer.home', ['title' => 'Home', 'Rooms' => Room::all()]);
  }

  public function explore() {
    return view('customer.explore', ['title' => 'Explore', 'Services' => Service::get()]);
  }

  public function rooms() {
    return view('customer.rooms', ['title' => 'Rooms', 'Rooms' => Room::get()]);
  }

  public function about() {
    return view('customer.about', ['title' => 'About']);
  }

  public function contact() {
    return view('customer.contact', ['title' => 'Contact']);
  }

  public function booking() {
    return view(
      'customer.booking',
      ['title' => 'Booking'],
      [
        'RoomSizes' => RoomSizeType::get(),
        'RoomTypes' => Room::get(),
        'Services' => Service::where('ServiceStatus', 'Available')->get(),
        'HasPendingBooking' => Booking::where('UserID', Auth::id())
          ->where('BookingStatus', 'Pending')
          ->orderBy('created_at', 'desc')
          ->first(),
      ]
    );
  }

  public function BookingDetails(Request $request) {
    $this->AccessCheck();

    $booking = null;
    $totalAmount = session('TotalAmount');

    // Try session BookingID first
    $bookingID = session('BookingID');
    if ($bookingID) {
      $booking = Booking::with(['room', 'roomSize', 'services'])
        ->where('ID', $bookingID)
        ->where('UserID', Auth::id())
        ->first();
    }

    // If no session booking, get latest pending booking
    if (!$booking) {
      $booking = Booking::with(['Room', 'RoomSize', 'Services'])
        ->where('UserID', Auth::id())
        ->where('BookingStatus', 'Pending')
        ->orderBy('created_at', 'desc')
        ->first();
    }

    // $bookingDetail = Booking::where('BookingID', $bookingID)->firstOrFail();

    // Calculate costs
    $roomPrice = $guestFee = $serviceCost = $subtotal = $discount = 0;
    // dd($booking);
    if ($booking) {
      $roomPrice = $booking->Room->RoomPrice;
      $guestFee = $booking->RoomSize->PricePerPerson * $booking->NumberOfGuests;
      $serviceCost = $booking->Services->sum('ServicePrice');
      $subtotal = $roomPrice + $guestFee + $serviceCost;
      $userLoyalty = UserLoyalty::where('UserID', Auth::id())->first();
      if ($userLoyalty && $userLoyalty->LoyaltyTierID) {
        $tier = LoyaltyTier::where('ID', $userLoyalty->LoyaltyTierID)->first();
        $discount = $subtotal * ($tier->Discount / 100);
      }
      $totalAmount ??= $subtotal - $discount;
      // dd($userLoyalty, $tier, $discount, $subtotal);

      $request->session()->put('bookingDetailID', $booking->ID);
      $request->session()->put('totalAmount', $totalAmount);
    }

    return view('customer.bookingdetails', [
      'title' => 'Booking Details',
      'tier' => $tier,
      'booking' => $booking,
      'bookingDetail' => $booking, // Alias for compatibility
      'roomPrice' => $roomPrice,
      'guestFee' => $guestFee,
      'serviceCost' => $serviceCost,
      'subtotal' => $subtotal,
      'discount' => $discount,
      'totalAmount' => $totalAmount,
      'PaymentProcessed' => PaymentInfo::where('BookingDetailID', $request->session()->get('bookingDetailID'))->where('PaymentStatus', 'Completed')->first(),
    ]);
  }

  public function checkout($RoomID) {
    return view(
      'customer.checkout',
      ['title' => 'Checkout'],
      ['Room' => Room::findOrFail($RoomID)]
    );
  }

  private function AccessCheck() {
    if (!Auth::check()) {
      abort(403, 'Unauthorized action.');
    }
  }
}
