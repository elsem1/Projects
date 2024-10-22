<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\RegisteredUserController;
use App\Mail\JobPosted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('test', function () {
    return new JobPosted();
});

Route::get('test', function () {
    Mail::to('example@mail.com')->send(
        new JobPosted()
    );
    return 'Done';
});

Route::view('/', 'home');
Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::controller(JobController::class)->group(function () {
    Route::get('/jobs', 'index');
    Route::get('/jobs/create', 'create');
    Route::get('/jobs/{job}', 'show');
    Route::post('/jobs', 'store')
        ->middleware('auth'); // zorgt ervoor dat alleen ingelogde users een nieuwe listing kunnen aanmaken

    Route::get('/jobs/{job}/edit', 'edit')
        ->middleware('auth')
        ->can('edit', 'job'); // zorgt ervoor dat alleen de user die een listing heeft gemaakt deze kan editen

    Route::patch('/jobs/{job}', 'update');
    Route::delete('/jobs/{job}', 'destroy');
});

// Route::resource('jobs', JobController::class, [ Dit doet hetzelfde als alles hierboven
//     'only' => ['edit', 'show', 'delete']
//         of
//     'except' => ['update']
// ]); 

// Auth
Route::get('/register', [RegisteredUserController::class, 'create']);
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::get('/login', [LoginController::class, 'create'])
    ->name('login');

Route::post('/login', [LoginController::class, 'store']);
Route::post('/logout', [LoginController::class, 'destroy']);