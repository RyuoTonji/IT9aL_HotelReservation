<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckoutController;
use App\Models\Booking;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/explore', [PageController::class, 'explore'])->name('explore');
Route::get('/rooms', [PageController::class, 'rooms'])->name('rooms');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/booking', [PageController::class, 'booking'])->name('booking');

Route::post('/register', [AuthController::class, 'RegisterUser'])->name('register');
Route::post('/login', [AuthController::class, 'LoginUser'])->name('login');
Route::post('/logout', [AuthController::class, 'LogoutUser'])->name('logout');

Route::middleware('RestrictByRole:Customer,Cashier')->group(function () {
  // Route::get('/room/{RoomID}/checkout', [PageController::class, 'checkout'])->name('checkout');
  Route::post('/booking', [BookingController::class, 'AppendBooking'])->name('append.booking');
  Route::get('/booking/details', [PageController::class, 'BookingDetails'])->name('booking.details');
  Route::get('/booking/checkout', [CheckoutController::class, 'CheckoutForm'])->name('checkout.form');
  Route::post('/booking/checkout', [CheckoutController::class, 'CheckoutForm'])->name('checkout.form');
  Route::post('/booking/process-payment', [CheckoutController::class, 'ProcessPayment'])->name('process.payment');
  Route::post('/booking/{BookingID}/cancel', [BookingController::class, 'CancelBooking'])->name('cancel.booking');
});

Route::prefix('/admin')->middleware('RestrictByRole:Admin')->group(function () {
  Route::get('/', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
});
// Route::prefix('/admin')->group(function () {
// });

// Future cashier routes (add when needed)
// Route::prefix('/cashier')->middleware('RestrictByRole:Cashier')->group(function () {
//     Route::get('/', [CashierController::class, 'dashboard'])->name('cashier.dashboard');
// });
