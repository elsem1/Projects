<x-layout>
    <x-slot:heading>
        Job Details
    </x-slot:heading>

    <h2><strong>{{ $job->title }}</strong></h2>
    <p>Salary: This job pays € {{ number_format($job->salary, 0, ',', '.') }}
    per year.</p>
    <a href="/jobs" class="text-blue-500 hover:underline">Back to listings</a>
</x-layout>
