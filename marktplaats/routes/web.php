<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Profile route
Route::get('/profile', [UserController::class, 'index'])
    ->name('profile')
    ->middleware('auth');

// Login routes
Route::get('/login', [SessionController::class, 'create'])
    ->name('login')
    ->middleware('guest');

Route::post('/login', [SessionController::class, 'store'])
    ->middleware('guest');

// Registration route
Route::post('/register', [UserController::class, 'store'])
    ->middleware('guest')
    ->name('register');

// Logout route
Route::post('/logout', [SessionController::class, 'destroy'])
    ->name('logout')
    ->middleware('auth');



    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');



Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
