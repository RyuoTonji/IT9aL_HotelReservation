<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

  public function Dashboard() {
    if (!Auth::check()) {
      return back()->with('toast_error', 'You must be logged in to access this page.');
    } else if (Auth::user()->role !== 'Admin') {
      return back()->with('toast_error', 'Restricted.');
    }
    return view('admin.dashboard', ['title' => 'Dashboard']);
  }
}
