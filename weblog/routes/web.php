<?php

namespace App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;


Route::get('/', function () {
    return view('home');
})->name('home');


Route::controller(ArticleController::class)->group(function () {
    Route::get('/articles', 'index')->name('articles.index');
    Route::get('/articles/create', 'create')->middleware('auth')->name('articles.create');
    Route::get('/articles/{article}', 'show')->name('articles.show');
    Route::post('/articles', 'store')
        ->middleware('auth')
        ->name('articles.store');

    Route::get('/articles/{article}/edit', 'edit')
        ->middleware('auth')
        ->can('edit', 'article')
        ->name('articles.edit');

    Route::patch('/articles/{article}', 'update')->name('articles.update');
    Route::delete('/articles/{article}', 'destroy')->name('articles.destroy');
    Route::get('/premium-articles', [ArticleController::class, 'premiumArticles'])->name('articles.premium');


});

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->middleware('auth')->name('categories.store');
Route::get('/categories/create', [CategoryController::class, 'create'])->middleware('auth')->name('categories.create');

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware('auth')->name('categories.edit');
Route::patch('/categories/{category}', [CategoryController::class, 'show'])->middleware('auth')->name('categories.update');
Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->middleware('auth')->name('articles.comments.store');
Route::post('articles/{article}/images', [ArticleController::class, 'store'])->name('articles.images.store');


Route::get('/premium', [RegisterController::class, 'show'])->name('premium');

Route::get('/profile', [UserController::class, 'index']);

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/subscribe', [RegisterController::class, 'subscribeCreate'])->middleware('auth')->name('subscribe.create');
Route::post('/subscribe', [RegisterController::class, 'subscribeStore'])->middleware('auth')->name('subscribe.store');

Route::get('/login', [SessionController::class, 'create'])
    ->name('login');

Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);

