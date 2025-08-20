<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;


Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
