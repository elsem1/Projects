<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Models\Article;

Route::get('/', function () {
    return view('home');
    })->name('home');
    

Route::resource('articles', ArticleController::class);

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Route::get('/articles', function () {
//     $articles = Article::with('categories')->simplePaginate(10); 
//     return view('components.articles.index', compact('articles'));
// })->name('articles.index');

Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');

/*
Route::get('/articles', function () {})->name('articles'.index');
Route::get('/articles/create', function () {})->name('articles.create');
Route::post('/articles', function () {})->name('articles.store');
Route::get('/articles/{id}', function () {})->name('articles.show');
Route::get('/articles/{id}/edit', function () {})->name('articles.edit');
Route::put('/articles/{id}', function () {})->name('articles.update');
Route::delete('/articles/{id}', function () {})->name('articles.destroy');

Route::get('/articles/{id}/comments/{comment}', function () {})->name('article.comments.index');
Route::get('/articles/{id}/comments/{comment}/create', function () {})->name('article.comments.create');
Route::post('/articles/{id}/comments/{comment}', function () {})->name('article.comments.store');
Route::get('/articles/{id}/comments/{comment}', function () {})->name('articles.comments.show');
Route::get('/articles/{id}/comments/{comment}/edit', function () {})->name('articles.comments.edit');
Route::put('/articles/{id}/comments/{comment}', function () {})->name('articles.comments.update');
Route::delete('/articles/{id}/comments/{comment}', function () {})->name('articles.comments.destroy');

Route::get('/user/profile', function () {})->name('user.index');
Route::get('/user/create', function () {})->name('user.create');
Route::post('/user/profile', function () {})->name('user.store');
Route::get('/user/{id}', function () {})->name('user.show');
Route::get('/users/{id}/edit', function () {})->name('user.edit');
Route::put('/user/{id}', function () {})->name('user.update');
Route::delete('/user/{id}', function () {})->name('users.destroy');
*/