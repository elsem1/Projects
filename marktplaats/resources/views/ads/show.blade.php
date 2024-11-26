

<x-layout>

    <div class="ad-page container mx-auto my-8 px-4">
        <!-- Main Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Product Details -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <!-- Title and Meta -->
                <div class="mb-4">
                    <h1 class="text-2xl font-bold text-gray-800">{{ $ad->title }}</h1>
                    <div class="text-sm text-gray-500 flex justify-between mt-2">
                        <div>Views: {{ $ad->views }}</div>
                        <div>Date Listed: {{ $ad->created_at->diffForHumans() }}</div>
                    </div>
                </div>

                <!-- Images -->
                <div class="mb-6">
                   <div id="carouselExample" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        @foreach($slides as $slide)
            <x-carousel-slide
                :id="$slide['id']"
                :image="$slide['image']"
                :title="$slide['title']"
                :description="$slide['description']"
                :link="$slide['link']"
                :checked="$slide['checked']"
            />
        @endforeach
    </div>

    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

    <ol class="carousel-indicators">
        @foreach($slides as $index => $slide)
            <li data-target="#carouselExample" data-slide-to="{{ $index }}" class="{{ $slide['checked'] ? 'active' : '' }}"></li>
        @endforeach
    </ol>
</div>

                </div>

                <!-- Pricing and Bidding -->
                <div class="mb-6">
                    <div class="text-xl font-semibold text-gray-800 mb-2">
                         Asking Price: € {{ $ad->ask }}
                    </div>
                </div>

                <!-- Characteristics -->
                <div class="mb-6">
                    <h2 class="text-lg font-bold text-gray-700">Kenmerken</h2>
                    <ul class="mt-2 text-sm text-gray-600">
                        <li>Conditie: Nieuw</li>
                        <li>Kleur: Zwart</li>
                        <li>Maat: L</li>
                        <li>Eigenschappen: Waterdicht</li>
                        <li>Merk: XYZ</li>
                    </ul>
                </div>

                <!-- Description -->
                <div>
                    <h2 class="text-lg font-bold text-gray-700">Description</h2>
                    <p class="mt-2 text-sm text-gray-600 leading-relaxed">
                        {{ $ad->body }} </p>
                </div>
            </div>

            <!-- Seller Information -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-800">Seller</h2>
                    <p class="text-gray-600 mt-2">{{ $ad->user->name }}</p>
                    <p class="text-sm text-gray-500">Location: {{ $ad->user->residence }}</p>
                    <button class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg shadow hover:bg-green-600">
                        Send a message to the seller
                    </button>
                </div>

                <!-- Bidding Section -->
                <div class="border-t pt-4">
                    <h2 class="text-lg font-bold text-gray-800">Biedingen</h2>
                    <ul class="mt-2 text-sm text-gray-600">
                        @foreach ($ad->bids as $bid)
                        <li><strong> €{{ $bid->bid }}</strong> - By {{ $bid->user->name }} - At <italic>{{ $bid->created_at }}</italic></li>
                        @endforeach

                    </ul>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                        Doe een bod
                    </button>
                </div>
            </div>
        </div>
    </div>


</x-layout>
