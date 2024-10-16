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
    $jobs = Job::with('employer')->latest()->simplePaginate(10);
    return view('jobs.index', [
        'jobs' => $jobs
    ]);
});

Route::post('/jobs', function() {
    request()->validate([
        'title'=> ['required', 'min:3'],
        'salary'=> ['required'],
        'job_description'=> '',

    ]);
    
    
    Job::create([
        'title' => request('title'),
        'salary'=> request('salary'),
        'job_description'=> request('job_description'),
        'employer_id'=> 1
    ]);
    return redirect('/jobs');
});

Route::get('/jobs/create', function () {
    return view('jobs.create');
});

Route::get('/jobs/{id}/edit', function ($id) {
    $job = Job::find($id);
    return view('jobs.edit', ['job' => $job]);
});

Route::get('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});

Route::patch('/jobs/{id}', function ($id) {
    request()->validate([
        'title'=> ['required', 'min:3'],
        'salary'=> ['required'],
        'job_description'=> ['required'],
        ]);

    $job = Job::findOrFail($id);

    $job->title = request('title');
    $job->salary = request('salary');
    $job->job_description = request('job_description');
    $job->save();

    return redirect('/jobs/' .  $job->id);
});

Route::delete('/jobs/{id}', function ($id) {
    $job = Job::find($id);
    return view('jobs.show', ['job' => $job]);
});


Route::get('/contact', function () {
    return view('contact');
});