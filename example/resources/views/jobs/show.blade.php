<x-layout>
    <x-slot:heading>
        Job Details
    </x-slot:heading>

    <h2><strong>{{ $job->title }}</strong></h2>
    <h3 class= "text-red-500 font-bold hover:underline">Employer: {{ $job->employer->name }}</h3>
    <h3 class= "text-green-400">Sector: {{ $job->employer->sector }}</h3><br>
    <p>Salary: This job pays € {{ number_format($job->salary, 0, ',', '.') }}
    per year.</p><br>
    <p>{{ $job->job_description }}</p>
    <a href="/jobs" class="text-blue-500 hover:underline">Back to listings</a>
</x-layout>
