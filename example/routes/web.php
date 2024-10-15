<?php

use Illuminate\Support\Facades\Route;
use App\Models\Job;


Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/jobs', function () {
    // $jobs = Job::with('employer')->get() ipv $jobs = Job::all() Dit is eager loading. Zorgt ervoor dat er niet voor iedere job een nieuwe query wordt gedaan
    $jobs = Job::with('employer')->simplePaginate(10);
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});


Route::get('/contact', function () {
    return view('contact');
});