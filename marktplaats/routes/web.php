<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Events\SuccessfulRegistration;
use App\Http\Controllers\AdController;

Route::get('/', [AdController::class, 'slideShow'])->name('welcome');

// Profile route
Route::get('/profile', [UserController::class, 'index'])->name('user.profile')->middleware('auth');

// Login routes
Route::get('/login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'store'])->middleware('guest');

// Registration route
Route::post('/register', [UserController::class, 'store'])->middleware('guest')->name('register');

// Logout route
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth');

// Email verification routes
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [UserController::class, 'emailVerify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', [UserController::class, 'notification'])->middleware(['auth', 'throttle:6,1'])->name('verification.send');

// Reset email routes
Route::post('/forgot-password', [UserController::class, 'forgotPassword'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->middleware('guest')->name('password.update');

// Ad routes
Route::get('/ads/{id}', [AdController::class, 'show'])->name('ads.show');
Route::get('/ads/create', [AdController::class, 'create'])->middleware('auth')->name('ads.create');


Route::get('/test', function() { return 'Route works!'; });
