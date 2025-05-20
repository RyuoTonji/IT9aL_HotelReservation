<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/explore', [PageController::class, 'explore'])->name('explore');
Route::get('/rooms', [PageController::class, 'rooms'])->name('rooms');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/booking', [PageController::class, 'booking'])->name('booking');

Route::post('/register', [AuthController::class, 'RegisterUser'])->name('register');
Route::post('/login', [AuthController::class, 'LoginUser'])->name('login');
Route::post('/logout', [AuthController::class, 'LogoutUser'])->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/master-dashboard', [AdminController::class, 'masterDashboard'])->name('master_dashboard');
    Route::get('/frontdesk', [AdminController::class, 'frontDesk'])->name('frontdesk');
    Route::get('/guest', [AdminController::class, 'guest'])->name('guest');
    Route::get('/rooms', [AdminController::class, 'rooms'])->name('rooms');
    Route::get('/deals', [AdminController::class, 'deals'])->name('deals');
    Route::get('/rate', [AdminController::class, 'rate'])->name('rate');
});

// Route::get('/booking', [AdminController::class, 'createBooking'])->name('booking');
