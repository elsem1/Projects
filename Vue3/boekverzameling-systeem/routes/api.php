<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/books', [BookController::class, 'index']);
Route::post('/books', [BookController::class, 'store']);
Route::get('/books/{book}', [BookController::class, 'index']);
Route::put('/books/{book}', [BookController::class, 'update']);
Route::delete('/books/{book}', [BookController::class, 'destroy']);

Route::get('/genres', [BookController::class, 'genre']);
Route::get('/count', [AuthorController::class, 'booksPerAuthor', 'bookCount']);

Route::get('/authors', [AuthorController::class, 'index']);
Route::post('/authors', [AuthorController::class, 'store']);
Route::put('/authors/{author}', [AuthorController::class, 'update']);
Route::delete('/authors/{author}', [AuthorController::class, 'destroy']);


Route::get('/reviews', [ReviewController::class, 'index']);
Route::post('/reviews', [ReviewController::class, 'store']);
Route::put('/reviews/{review}', [ReviewController::class, 'update']);
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
