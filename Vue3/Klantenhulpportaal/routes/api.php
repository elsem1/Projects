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
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/ticket-statuses', [TickerStatusController::class, 'index']);


Route::get('/tickets', [TicketController::class, 'index']);
Route::post('/tickets', [TicketController::class, 'store']);
Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->middleware('auth');
Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->middleware('auth');

Route::get('/tickets/{ticket}/notes', [NoteController::class, 'index']);
Route::post('/tickets/{ticket}/notes', [NoteController::class, 'store']);
Route::put('/tickets/{ticket}/notes/{note}', [NoteController::class, 'update']);
Route::delete('/tickets/{ticket}/notes/{note}', [NoteController::class, 'destroy']);


Route::get('/tickets/{ticket}/replies', [ReplyController::class, 'index']);
Route::post('/tickets/{ticket}/replies', [ReplyController::class, 'store']);
Route::put('/tickets/{ticket}/replies/{reply}', [ReplyController::class, 'update']);
Route::delete('/tickets/{ticket}/replies/{reply}', [ReplyController::class, 'destroy']);
