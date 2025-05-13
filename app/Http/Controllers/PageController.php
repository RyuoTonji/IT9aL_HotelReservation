<?php

namespace App\Http\Controllers;

class PageController extends Controller {
  public function home() {
    return view('home', ['title' => 'Home']);
  }

  public function explore() {
    return view('explore', ['title' => 'Explore']);
  }

  public function rooms() {
    return view('rooms', ['title' => 'Rooms']);
  }

  public function about() {
    return view('about', ['title' => 'About']);
  }

  public function contact() {
    return view('contact', ['title' => 'Contact']);
  }

  public function booking() {
    return view('booking', ['title' => 'Booking']);
  }
}
