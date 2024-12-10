<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Events\SuccessfulRegistration;
use App\Http\Controllers\AdController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MessageController;

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
Route::get('/ads/create', [AdController::class, 'create'])->middleware('auth')->name('ads.create');
Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
Route::post('/ads', [Adcontroller::class, 'store'])->middleware('auth')->name('ads.store');
Route::get('/ads/{ad}', [AdController::class, 'show'])->name('ads.show');
Route::get('/ads/{ad}/edit,', [AdController::class, 'edit'])
    ->middleware('auth')
    ->can('edit', 'ad')
    ->name('ads.edit');
Route::post('/ads/{ad}/bids', [BidController::class, 'store'])
    ->middleware('auth')
    ->name('ads.bids.store');
Route::patch('/ads/{ad}', [ Adcontroller::class, 'update'])->name('ads.update');
Route::delete('/ads/{ad}', [AdController::class, 'destroy'])->name('ads.destroy');

// message routes
// Message routes
Route::middleware('auth')->group(function() {
    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/reply', [MessageController::class, 'reply'])->name('messages.reply');
    Route::get('messages/{message}/reply', [MessageController::class, 'createReply'])->name('messages.createReply');
    Route::delete('/messages/{message}', [MessageController::class, 'destroy'])->name('messages.destroy');
});

Route::middleware('auth')->group(function () {
    Route::post('/messages/reply', [MessageController::class, 'reply'])->name('messages.reply');
    Route::get('/messages/{message}', [MessageController::class, 'show'])->name('messages.show');
});


// // Category routes
// Route::get('/ads/categories/{category}', [AdController::class, 'categories'])->name('ads.categories');
// Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
// Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth')->name('categories.store');
// Route::get('/categories/create', [CategoryController::class, 'create'])->middleware('auth')->name('categories.create');
// Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
// Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware('auth')->name('categories.edit');
// Route::patch('/categories/{category}', [CategoryController::class, 'show'])->middleware('auth')->name('categories.update');
