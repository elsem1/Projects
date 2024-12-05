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

    <div class="ads-overview container mx-auto my-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Ads Section -->
            <div class="lg:col-span-2">
                <div class="ads-section p-6 bg-white shadow-md rounded-lg">
                    <h2 class="text-2xl font-semibold mb-4">All New Ads</h2>
                    <ul class="space-y-4">
                        @foreach ($ads as $ad)
                            <li class="p-4 border rounded-lg bg-gray-100 hover:bg-gray-200 transition duration-200">
                                <div class="flex items-center">
                                    <!-- Image Component -->
                                    <div class="w-1/4">
                                        <x-ad-img
                                            :image="$slide[$loop->index]['image']"
                                            :title="$slide[$loop->index]['title']"
                                            :description="$slide[$loop->index]['description']"
                                            :link="$slide[$loop->index]['link']"
                                        />
                                    </div>
    
                                    <!-- Ad Details -->
                                    <div class="w-3/4 pl-4">
                                        <h3>
                                            <a href="{{ route('ads.show', $ad->id) }}" class="text-gray-800 text-xl md:text-2xl no-underline hover:underline">
                                                {{ $ad->title }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-700">{{ Str::limit($ad->body, 100) }}</p>
                                        
                                        <p class="mt-2"><strong>Asking Price:</strong> €{{ $ad->ask }}</p>
    
                                        <!-- Views and Date Added -->
                                        <div class="mt-2 text-sm text-gray-500">
                                            <p><strong>Views:</strong> {{ $ad->views }} | <strong>Posted:</strong> {{ $ad->created_at->format('d M Y') }}</p>
                                        </div>
                                        
                                        @can('edit', $ad)
                                        <div class="mt-4 flex space-x-4">
                                            <a href="{{ route('ads.edit', $ad->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">
                                                Edit
                                            </a>
                                        </div>
                                        @endcan
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
    
                <!-- Pagination -->
                <div class="mt-6">
                    {{ $ads->links() }}
                </div>
            </div>           
    

            <!-- Additional Section -->
            <div class="lg:col-span-1 bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800">Lorem Ipsum</h2>
            </div>
        </div>
    </div>  
</x-layout>
