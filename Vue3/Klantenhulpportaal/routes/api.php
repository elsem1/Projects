<?php

use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\TickerStatusController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;


Route::post('/login', [SessionController::class, 'authenticate']);
Route::post('/logout', [SessionController::class, 'destroy']);
Route::get('/me', [SessionController::class, 'meRequest'])->middleware('auth:sanctum');
Route::get('/admins', [SessionController::class, 'getAdmins'])->middleware('auth:sanctum');
Route::post('/register', [SessionController::class, 'register']);

Route::post('/forgot-password', [SessionController::class, 'forgotPassword'])->middleware('guest');
Route::get('/reset-password/{token}', function (string $token) {
    ['token' => $token];
})->middleware('guest')->name('password.reset');
Route::post('/reset-password', [SessionController::class, 'resetPassword'])->middleware('guest');


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
