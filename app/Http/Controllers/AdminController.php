<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

  public function __construct() {
    $this->middleware('RestrictByRole:Admin');
  }

  public function Dashboard() {
    return view('admin.dashboard', ['title' => 'Dashboard']);
  }

  private function AdminCheck() {
    if (!Auth::check()) {
      if(Auth::user()->role !== 'Admin') {
        abort(403, 'Unauthorized action.');
      }
      abort(69420, 'Unauthorized action.');
    }
  }
}
