<x-layout>
    <div class="content-wrapper max-w-screen-lg mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
        <x-title>
            <x-slot:title>
                Profile Dashboard
            </x-slot:title>
            <x-slot:description>
                This is your private dashboard
            </x-slot:description>
        </x-title>
    </div>

    <div class="ads-section p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Your Ads</h2>
        <ul class="space-y-4">
            @foreach ($ads as $ad)
                <li class="p-4 border rounded-lg bg-gray-100 hover:bg-gray-200 transition duration-200">
                    <h3><a href="{{ route('ads.show', $ad->id) }}" class="text-gray-800 text-xl md:text-2xl no-underline hover:underline">
                        {{ $ad->title }}
                    </a></h3>
                    <p class="text-gray-700">{{ $ad->description }}</p>
                    <p class="mt-2"><strong>Price:</strong> {{ $ad->price }}</p>
                </li>
            @endforeach
        </ul>
    </div>
    
</x-layout>
