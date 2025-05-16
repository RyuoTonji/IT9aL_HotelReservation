<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\RestrictByRole;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/explore', [PageController::class, 'explore'])->name('explore');
Route::get('/rooms', [PageController::class, 'rooms'])->name('rooms');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/booking', [PageController::class, 'booking'])->name('booking');

Route::post('/register', [AuthController::class, 'RegisterUser'])->name('register');
Route::post('/login', [AuthController::class, 'LoginUser'])->name('login');
Route::post('/logout', [AuthController::class, 'LogoutUser'])->name('logout');

//
//Route::middleware(RestrictByRole::class.':Customer')->group(function () {
//});
Route::get('/room/{RoomID}/checkout', [PageController::class, 'checkout'])->name('checkout');

//->middleware(RestrictByRole::class.':Admin')
Route::prefix('/admin')->group(function () {
  Route::get('/', [AdminController::class, 'Dashboard'])->name('admin.dashboard');
});
