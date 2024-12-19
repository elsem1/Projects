<x-layout>
    <div class="content-wrapper max-w-screen-lg mx-auto px-4 sm:px-6 lg:px-8 flex justify-center">
        <x-title>
            <x-slot:title>
                All our Ads
            </x-slot:title>
            <x-slot:description>
                Look around and find something new to buy!
            </x-slot:description>
        </x-title>
    </div>

    <div class="ads-overview container mx-auto my-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="ads-section p-6 bg-white shadow-md rounded-lg lg:col-span-2">
                <h2 class="text-2xl font-semibold mb-4">All New Ads</h2>
                <!-- Searchbar -->
                <form action="{{ route('ads.index') }}" method="GET">
                    <input type="text" name="query" class="mb-5 0" placeholder="Search ads.."
                        value="{{ old('query', request()->input('query')) }}">
                    <button type="submit">Search</button>
                </form>

                <!-- Dropdownmenu voor de categorieen -->
                <div class="dropdown" style="float:right;">
                    <button class="dropbtn">Categories</button>
                    <div class="dropdown-content">
                        <hr style="margin: 5px 0; border: 1px solid #ccc;">
                        @foreach ($categories as $category)
                            <a
                                href="{{ route('ads.index', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>

                <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($ads as $ad)
                        <li class="p-4 border rounded-lg bg-gray-100 hover:bg-gray-200 transition duration-200">
                            <div class="flex items-center">
                                <div class="w-1/4">
                                    <x-ad-img :image="$slide[$loop->index]['image']" :title="$slide[$loop->index]['title']" :description="$slide[$loop->index]['description']" :link="$slide[$loop->index]['link']" />
                                </div>

                                <div class="w-3/4 pl-4">
                                    <h3>
                                        <a href="{{ route('ads.show', $ad->id) }}"
                                            class="text-gray-800 text-xl md:text-2xl no-underline hover:underline">
                                            {{ $ad->title }}
                                        </a>
                                        <div>
                                            @if ($ad->isPremium())
                                                <span
                                                    class="text-sm font-bold text-white bg-yellow-500 px-2 py-1 rounded-full"
                                                    style="float:right;">Premium</span>
                                            @endif
                                        </div>
                                        <h6>
                                            @if ($ad->categories->count())
                                                <span>
                                                    Categor{{ $ad->categories_count !== 1 ? 'ies' : 'y' }}:
                                                    @foreach ($ad->categories as $category)
                                                        <a href="{{ route('ads.index', $category->id) }}"
                                                            class="text-blue-400 hover:underline">{{ $category->name }}</a>
                                                        @if (!$loop->last)
                                                            ,
                                                        @endif
                                                    @endforeach
                                                </span>
                                            @endif
                                        </h6>

                                    </h3>
                                    <p class="text-gray-700">{{ Str::limit($ad->body, 100) }}</p>
                                    <p class="mt-2"><strong>Asking Price:</strong> €{{ $ad->ask }}</p>
                                    <div class="mt-2 text-sm text-gray-500">
                                        <p><strong>Views:</strong> {{ $ad->views }} | <strong>Posted:</strong>
                                            {{ $ad->created_at->format('d M Y') }}</p>
                                    </div>

                                    @can('edit', $ad)
                                        <div class="mt-4 flex space-x-4">
                                            <a href="{{ route('ads.edit', $ad->id) }}"
                                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg shadow hover:bg-yellow-600">
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

            <div class="mt-6 lg:col-span-2">
                {{ $ads->links() }}
            </div>
        </div>
    </div>
</x-layout>
