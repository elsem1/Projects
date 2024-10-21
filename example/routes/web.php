<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::view('/', 'home');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::controller(JobController::class)->group(function(){
    Route::get('/jobs',  'index');
    Route::get('/jobs/create',  'create');
    Route::get('/jobs/{job}',  'show');
    Route::post('/jobs',  'store');
    Route::get('/jobs/{job}/edit',  'edit');
    Route::patch('/jobs/{job}',  'update');
    Route::delete('/jobs/{job}',  'destroy');
});

// Route::resource('jobs', JobController::class, [ Dit doet hetzelfde als alles hierboven
//     'only' => ['edit', 'show', 'delete']
//         of
//     'except' => ['update']
// ]); 

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [LoginController::class, 'create']);
Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy']);