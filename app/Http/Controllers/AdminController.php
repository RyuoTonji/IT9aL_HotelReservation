<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
