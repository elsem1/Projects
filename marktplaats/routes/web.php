<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', [UserController::class, 'index']);
Route::get('/login', [SessionController::class, 'create'])
    ->name('login');


    