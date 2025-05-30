<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ReservationActionsController;
use App\Http\Controllers\CheckoutController;
use App\Models\Booking;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/explore', [PageController::class, 'explore'])->name('explore');
Route::get('/rooms', [PageController::class, 'rooms'])->name('rooms');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/booking', [PageController::class, 'booking'])->name('booking');
Route::post('/booking', [PageController::class, 'booking'])->name('booking');

Route::post('/register', [AuthController::class, 'RegisterUser'])->name('register');
Route::post('/login', [AuthController::class, 'LoginUser'])->name('login');
Route::post('/logout', [AuthController::class, 'LogoutUser'])->name('logout');

Route::middleware('RestrictByRole:Customer,Cashier')->group(function () {
  Route::get('/reservation', [PageController::class, 'Reservation'])->name('reservation');
  Route::post('/booking/append', [BookingController::class, 'AppendBooking'])->name('append.booking');
  Route::get('/booking/checkout', [CheckoutController::class, 'CheckoutForm'])->name('checkout');
  Route::post('/booking/process-payment', [CheckoutController::class, 'ProcessPayment'])->name('process.payment');
  Route::post('/booking/{BookingID}/cancel', [BookingController::class, 'CancelBooking'])->name('cancel.booking');
});

Route::prefix('/admin')->name('admin.')->middleware('RestrictByRole:Admin')->group(function () {
  Route::get('/', [AdminController::class, 'Dashboard'])->name('dashboard');
  Route::get('/master-dashboard', [AdminController::class, 'masterDashboard'])->name('master_dashboard');
  Route::get('/frontdesk', [AdminController::class, 'frontDesk'])->name('frontdesk');
  Route::get('/guest', [AdminController::class, 'guest'])->name('guest');
  Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
  Route::get('/deals', [AdminController::class, 'deals'])->name('deals');
  Route::get('/rate', [AdminController::class, 'rate'])->name('rate');

  Route::get('booking/{id}/review', [ReservationActionsController::class, 'reviewBooking'])->name('booking.review');
  Route::patch('booking/{id}/accept', [ReservationActionsController::class, 'acceptPayment'])->name('booking.accept');
  Route::patch('booking/{id}/reject', [ReservationActionsController::class, 'rejectPayment'])->name('booking.reject');
  Route::patch('booking/{id}/checkin', [ReservationActionsController::class, 'checkIn'])->name('booking.checkin');
  Route::patch('booking/{id}/checkout', [ReservationActionsController::class, 'checkOut'])->name('booking.checkout');
  Route::patch('booking/{id}/cancel', [ReservationActionsController::class, 'cancelBooking'])->name('booking.cancel');
});
// Route::prefix('/admin')->group(function () {
// });

// Future cashier routes (add when needed)
// Route::prefix('/cashier')->middleware('RestrictByRole:Cashier')->group(function () {
//     Route::get('/', [CashierController::class, 'dashboard'])->name('cashier.dashboard');
// });
