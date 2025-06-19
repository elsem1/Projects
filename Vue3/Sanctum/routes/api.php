<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Login routes
Route::get('/login', [SessionController::class, 'create'])->name('login')->middleware('guest');
Route::post('/login', [SessionController::class, 'authenticate'])->middleware('guest');

// Registration route
Route::post('/register', [UserController::class, 'store'])->middleware('guest')->name('register');

// Logout route
Route::post('/logout', [SessionController::class, 'destroy'])->name('logout')->middleware('auth:sanctum');
