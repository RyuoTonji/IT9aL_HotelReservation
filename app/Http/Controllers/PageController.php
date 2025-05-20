<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\LoyaltyTier;
use App\Models\Service;
use App\Models\PaymentInfo;
use Illuminate\Support\Facades\Auth;
use App\Models\RoomSize;
use App\Models\RoomType;
use App\Models\UserLoyalty;
use Illuminate\Http\Request;

class PageController extends Controller {
  public function home() {
    return view('customer.home', ['title' => 'Home', 'Rooms' => RoomType::all()]);
  }

  public function explore() {
    return view('customer.explore', ['title' => 'Explore', 'Services' => Service::get()]);
  }

  public function rooms() {
    return view('customer.rooms', ['title' => 'Rooms', 'Rooms' => RoomSize::get()]);
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
        'RoomSizes' => RoomSize::get(),
        'RoomTypes' => RoomType::get(),
        'Services' => Service::where('ServiceStatus', 'Available')->get(),
        'HasPendingBooking' => Booking::where('UserID', Auth::id())
          ->where('BookingStatus', 'Pending')
          ->orderBy('created_at', 'desc')
          ->first(),
      ]
    );
  }

  public function CheckoutForm(Request $request) {
    $this->AccessCheck();

    $booking = null;
    $costDetails = null;
    $tier = null;

    // Try session BookingID first
    $bookingID = session('BookingID');
    if ($bookingID) {
      $booking = Booking::with(['room', 'roomSize', 'services', 'costDetails'])
        ->where('ID', $bookingID)
        ->where('UserID', Auth::id())
        ->first();
    }

    // If no session booking, get latest pending booking
    if (!$booking) {
      $booking = Booking::with(['room', 'roomSize', 'services', 'costDetails'])
        ->where('UserID', Auth::id())
        ->where('BookingStatus', 'Pending')
        ->orderBy('created_at', 'desc')
        ->first();
    }

    if ($booking) {
      $costDetails = $booking->costDetails;
      $userLoyalty = UserLoyalty::where('UserID', Auth::id())->first();
      if ($userLoyalty && $userLoyalty->LoyaltyTierID) {
        $tier = LoyaltyTier::where('ID', $userLoyalty->LoyaltyTierID)->first();
      }

      $request->session()->put('BookingID', $booking->ID);
    }

    return view('customer.payment', [
      'title' => 'Booking Details',
      'tier' => $tier,
      'booking' => $booking,
      'costDetails' => $costDetails,
      'PaymentProcessed' => $booking ? PaymentInfo::where('BookingDetailID', $booking->ID)
        ->where('PaymentStatus', 'Submitted')
        ->first() : null,
    ]);
  }

  public function checkout($RoomID) {
    return view(
      'customer.checkout',
      ['title' => 'Checkout'],
      ['Room' => RoomType::findOrFail($RoomID)]
    );
  }

  private function AccessCheck() {
    if (!Auth::check()) {
      abort(403, 'Unauthorized action.');
    }
  }
}
