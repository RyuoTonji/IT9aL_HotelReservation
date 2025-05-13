<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
  public function RegisterUser(Request $request) {
    $request->validateWithBag('register', [
      'username' => 'required|unique:users',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6|confirmed',
      'password_confirmation' => 'required|min:6',
    ]);

    User::create([
      'username' => $request->username,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    return back()->with('toast_success', 'Registration successful! You can now log in.');
  }

  public function LoginUser(Request $request) {
    $request->validate([
      'email' => 'required|email',
      'password' => 'required',
    ]);

    if (!Auth::attempt($request->only('email', 'password'))) {
      return back()->with([
        'toast_error' => 'Login failed. Check your credentials.',
        'LoginError' => 'Login failed. Check your credentials.'
      ])->withInput($request->only('email'));
    }

    return back()->with('toast_success', 'Login successful!');
  }

  public function LogoutUser(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return back()->with('toast_success', 'Logout successful!');
  }
}
