<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

// Login route
Route::post('/login', [SessionController::class, 'authenticate']);

// me request
Route::get('/me', [SessionController::class, 'meRequest'])->middleware('auth:sanctum');
