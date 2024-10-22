<x-mail::message>
<h2>{{ $job->title }}</h2>
Congratulations, you succesfully created a new job listing!

<a href="{{ url('/jobs/' . $job->id) }}">View Your Job Listing</a>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
