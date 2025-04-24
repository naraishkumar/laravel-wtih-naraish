<?php
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

// Show login form
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');

// Handle login form submission
Route::post('login', [LoginController::class, 'login']);

// Logout route
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('verify-otp/{email}', [RegisterController::class, 'showOtpForm'])->name('otp.verify.form');
Route::post('verify-otp', [RegisterController::class, 'verifyOtp'])->name('otp.verify');


// 👤 User App Route
Route::get('/', function () {
    return view('app.index');
})->name('app.home');

// 🛠️ Admin Dashboard Route
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('admin.dashboard');


