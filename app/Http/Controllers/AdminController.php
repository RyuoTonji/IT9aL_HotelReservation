<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;

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

  public function guest() {
    return view('admin.guest');
  }

  public function rooms() {
    return view('admin.rooms');
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
=======

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function masterDashboard()
    {
        return view('admin.master_dashboard');
    }

    public function frontDesk()
    {
        return view('admin.frontdesk');
    }

    public function guest()
    {
        return view('admin.guest');
    }

    public function rooms()
    {
        return view('admin.rooms');
    }

    public function deals()
    {
        return view('admin.deals');
    }

    public function rate()
    {
        return view('admin.rate');
    }

    public function createBooking()
    {
        return view('admin.booking');
    }
>>>>>>> 315a6fc3ef544ade10ca14731ef09ec41feee53c
}
