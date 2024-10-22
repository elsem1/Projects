<?php

namespace App\Http\Controllers;
use App\Mail\JobPosted;
use App\Models\Job;
use Mail;



class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::with('employer')->latest()->simplePaginate(10);
        return view('jobs.index', [
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function show(Job $job)
    {

        return view('jobs.show', ['job' => $job]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
            'job_description' => '',

        ]);


        $job = Job::create([
            'title' => request('title'),
            'salary' => request('salary'),
            'job_description' => request('job_description'),
            'employer_id' => 1
        ]);

        Mail::to($job->employer->user)->queue(
            new JobPosted($job)
        );

        return redirect('/jobs');
    }

    public function edit(Job $job)
    {
        // Gate::authorize('edit-job', $job); // de eerder gedefinieerde (in Providers/AppServiceProvider) gate kijkt hier of de user geauthoriseerd is voor het editen van de job


        // if ($job->employer->user->isNot(Auth::user())) // is is een method in models en kijkt of de twee gelijk aan elkaar zijn, isNot is het tegenovergestelde
        // {                                                 can en cannot zijn vergelijkbaar, deze geven aan wat een user of guest wel of niet kan qua bevoegdheden
        //     abort(403);
        // }
        return view('jobs.edit', ['job' => $job]);
    }

    public function update(Job $job)
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'salary' => ['required'],
            'job_description' => ['required'],
        ]);


        $job->update([
            'title' => request('title'),
            'salary' => request('salary'),
            'job_description' => request('job_description'),
        ]);

        return redirect('/jobs/' . $job->id);
    }

    public function destroy(Job $job)
    {
        $job->delete();

        return redirect('/jobs');
    }
}
