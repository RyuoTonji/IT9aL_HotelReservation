<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

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
    return view('customer.booking', ['title' => 'Booking']);
  }

  public function checkout($RoomID) {
    return view('customer.checkout', ['title' => 'Checkout'], ['Room' => Room::findOrFail($RoomID)]);
  }

  private function AccessCheck() {
    if (!Auth::check()) {
      abort(403, 'Unauthorized action.');
    }
  }
}
