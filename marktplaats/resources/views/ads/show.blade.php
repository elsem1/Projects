        <x-layout>
            <div class="ad-page container mx-auto my-8 px-4">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                        <div class="mb-4">
                            <h1 class="text-2xl font-bold text-gray-800">{{ $ad->title }}</h1>
                            <div class="text-sm text-gray-500 flex justify-between mt-2">
                                <div>Views: {{ $ad->views }}</div>
                                <div>Date Listed: {{ $ad->created_at->diffForHumans() }}</div>
                            </div>
                        </div>

                        <!-- Image -->
                        <div class="mb-6">
                            <x-ad-img :image="$slide[0]['image']" :title="$slide[0]['title']" :description="$slide[0]['description']" :link="$slide[0]['link']" />
                        </div>

                        <!-- Prijs -->
                        <div class="mb-6">
                            <div class="text-xl font-semibold text-gray-800 mb-2">
                                Asking Price: €{{ $ad->ask }}
                            </div>
                        </div>


                        <div class="mb-6">
                            <h2 class="text-lg font-bold text-gray-700">Characteristics</h2>
                            <ul class="mt-2 text-sm text-gray-600">
                                <li>Condition: New</li>
                                <li>Color: Black</li>
                                <li>Size: Large</li>
                                <li>Properties: Waterproof</li>
                                <li>Brand: XYZ</li>
                            </ul>
                        </div>

                        <!-- Description -->
                        <div>
                            <h2 class="text-lg font-bold text-gray-700">Description</h2>
                            <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                                {{ $ad->body }}
                            </p>
                        </div>
                    </div>

                    <!-- Seller info -->
                    <div class="bg-white shadow-md rounded-lg p-6">
                        <div class="mb-6">
                            <h2 class="text-xl font-bold text-gray-800">Seller</h2>
                            <p class="text-gray-600 mt-2">{{ $ad->user->name }}</p>
                            <p class="text-sm text-gray-500 mb-2">Location: {{ $ad->user->residence }}</p>
                            <a href="{{ route('messages.create', $ad->id) }}"
                                class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">
                                Send a Message to the Seller
                            </a>
                        </div>

                        <!-- Deel voor biedingen -->
                        @include('components.bid-box')
                    </div>

                </div>
            </div>
        </x-layout>
