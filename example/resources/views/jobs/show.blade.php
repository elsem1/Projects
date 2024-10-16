<x-layout>
    <x-slot:heading>
        Job Details
    </x-slot:heading>

    <h2><strong>{{ $job->title }}</strong></h2>
    <h3 class= "text-red-500 font-bold hover:underline">Employer: {{ $job->employer->name }}</h3>
    <h3 class= "text-green-400">Sector: {{ $job->employer->sector }}</h3><br>
    <p>Salary: This job pays € {{ number_format($job->salary, 0, ',', '.') }}
    per year.</p><br>
    <p>This is what the job is about:<br> {{ $job->job_description }}</p><br>
    <a href="/jobs" class="text-blue-500 hover:underline">Back to listings</a>

    <p class="mt-6">
        <x-button href="/jobs/{{ $job->id }}/edit">Edit Job</x-button>
    </p>
</x-layout>
