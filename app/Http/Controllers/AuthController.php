<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {
  public function RegisterUser(Request $request) {
    $request->validateWithBag('register', [
      'Name' => 'required|regex:/^[A-Za-z]{0,20}+(?:\s+[A-Za-z]+(?:\.[A-Za-z]*)?)?(?:\s+[A-Za-z]+(?:\.[A-Za-z]*)?){0,4}?$/m',
      'Username' => 'required|unique:users|regex:/^[A-Za-z0-9]+(_[A-Za-z0-9]+)?(\.[A-Za-z0-9]+)?$/',
      'email' => 'required|email|unique:users',
      'password' => 'required|min:6|confirmed',
      'password_confirmation' => 'required|min:6',
    ], [
      'Name.required' => 'The name field is required.',
      'Name.regex' => 'The name must be a valid name format, optional Surname or Middle Initial.',
      'Username.required' => 'The username field is required.',
      'Username.unique' => 'This username is already taken.',
      'Username.regex' => 'The username must contain only letters, numbers, one optional underscore, and one optional dot (e.g., "john_doe.123"). No spaces or other special characters are allowed.',
      'email.required' => 'The email field is required.',
      'email.email' => 'The email must be a valid email address.',
      'email.unique' => 'This email is already registered.',
      'password.required' => 'The password field is required.',
      'password.min' => 'The password must be at least 6 characters.',
      'password.confirmed' => 'The password confirmation does not match.',
      'password_confirmation.required' => 'The password confirmation field is required.',
      'password_confirmation.min' => 'The password confirmation must be at least 6 characters.',
    ]);

    User::create([
      'Name' => ucwords($request->Name),
      'Username' => $request->Username,
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

    if (Auth::user()->Role === 'Admin') {
      return redirect()->route('admin.dashboard');
    }
    return back()->with('toast_success', 'Login successful!');
  }

  public function LogoutUser(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home')->with('toast_success', 'Logout successful!');
  }
}
