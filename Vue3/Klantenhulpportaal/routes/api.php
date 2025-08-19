<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TickerStatusController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

Route::post('/login', [SessionController::class, 'authenticate']);
Route::post('/logout', [SessionController::class, 'destroy']);
Route::get('/me', [SessionController::class, 'meRequest'])->middleware('auth:sanctum');
Route::get('/admins', [SessionController::class, 'getAdmins'])->middleware('auth:sanctum');

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

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);
    $status = Password::sendResetLink(
        $request->only('email')
    );
    return $status === Password::ResetLinkSent
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);
    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));
            $user->save();
            event(new PasswordReset($user));
        }
    );
    return $status === Password::PasswordReset
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');


Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/ticket-statuses', [TickerStatusController::class, 'index']);

Route::get('/tickets', [TicketController::class, 'index'])->middleware(['verified', 'auth:sanctum']);
Route::post('/tickets', [TicketController::class, 'store'])->middleware(['verified', 'auth:sanctum']);
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->middleware(['verified', 'auth:sanctum']);
Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->middleware(['verified', 'auth:sanctum']);
Route::put('/tickets/{ticket}/assign', [TicketController::class, 'assign'])->middleware(['verified', 'auth:sanctum']);

Route::get('/tickets/{ticket}/notes', [NoteController::class, 'index'])->middleware(['verified', 'auth:sanctum']);
Route::post('/tickets/{ticket}/notes', [NoteController::class, 'store'])->middleware(['verified', 'auth:sanctum']);
Route::put('/tickets/{ticket}/notes/{note}', [NoteController::class, 'update'])->middleware(['verified', 'auth:sanctum']);
Route::delete('/tickets/{ticket}/notes/{note}', [NoteController::class, 'destroy'])->middleware(['verified', 'auth:sanctum']);

Route::get('/tickets/{ticket}/replies', [ReplyController::class, 'index'])->middleware(['verified', 'auth:sanctum']);
Route::post('/tickets/{ticket}/replies', [ReplyController::class, 'store'])->middleware(['verified', 'auth:sanctum']);
Route::put('/tickets/{ticket}/replies/{reply}', [ReplyController::class, 'update'])->middleware(['verified', 'auth:sanctum']);
Route::delete('/tickets/{ticket}/replies/{reply}', [ReplyController::class, 'destroy'])->middleware(['verified', 'auth:sanctum']);
