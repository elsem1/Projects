<?php

namespace App\Http\Controllers\UserController;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;


Route::get('/', function () {
    return view('home');
    })->name('home');
    

Route::controller(ArticleController::class)->group(function(){ 
    Route::get ('/articles', 'index')->name('articles.index');
    Route::get('/articles/create', 'create')->name('articles.create');
    Route::get('/articles/{article}','show')->name('articles.show');
    Route::post('/articles','store')
        ->middleware('auth')
        ->name('articles.store');

    Route::get('/articles/{article}/edit','edit')
        ->middleware('auth')
        ->can('edit', 'article')
        ->name('articles.edit');

    Route::patch('/articles/{article}', 'update')->name('articles.update');
    Route::delete('/articles/{article}','destroy')->name('articles.destroy');
    
});
Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('articles.comments.store');


Route::get('/profile', [UserController::class, 'index']);

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])
    ->name('login');

Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);





// Route::get('/login', function() {
//     return view('/login/index');
//     })->name('login');





