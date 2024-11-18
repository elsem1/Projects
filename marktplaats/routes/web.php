<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/profile', [UserController::class, 'index'])->name('profile')->middleware('auth');

Route::get('/login', function() {
    return view('auth.login');
})->name('login');
    