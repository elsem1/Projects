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
                    <h2 class="text-2xl font-semibold mb-4">All My Ads</h2>
                    <ul class="space-y-4">
                        @foreach ($ads as $ad)
                            <li class="p-4 border rounded-lg bg-gray-100 hover:bg-gray-200 transition duration-200">
                                <div class="flex items-center">
                                    <!-- Image Component -->
                                    <div class="w-1/4">
                                        <x-ad-img :image="$slide[$loop->index]['image']" :title="$slide[$loop->index]['title']" :description="$slide[$loop->index]['description']"
                                            :link="$slide[$loop->index]['link']" />
                                    </div>

                                    <!-- Ad Details -->
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
                                        </h3>
                                        <p class="text-gray-700">{{ Str::limit($ad->body, 100) }}</p>

                                        <p class="mt-2"><strong>Asking Price:</strong> €{{ $ad->ask }}</p>

                                        <!-- Views and Date Added -->
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

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $ads->links() }}
                </div>
            </div>


            <!-- Additional Section -->
            <div>
                <form action="{{ route('user.updateNotifications') }}" method="POST">
                    @csrf
                    <div class="lg:col-span-1 bg-white shadow-md rounded-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800">Settings</h2>
                        <label for="notifications">Receive Notifications</label>
                        <input type="checkbox" name="receive_notifications" id="notifications"
                            {{ Auth::user()->receive_notifications ? 'checked' : '' }}>

                        <button type="submit" class="mt-4 p-2 bg-blue-500 text-white rounded">Save</button>
                    </div>
                </form>

                <div>
                    <form id="buyPremiumForm" action="{{ route('ads.buyPremium') }}" method="POST">
                        @csrf
                        <div class="lg:col-span-1 bg-white shadow-md rounded-lg p-6">
                            <h2 class="text-xl font-bold text-gray-800">Premium Subscription</h2>
                            <p>Want to place your ad on top again to get more views?</p>
                            <p class="mt-3 mb-3" for="premium">Buy Premium Subscription for €10</p>

                            <div class="relative mt-6">
                                <label for="ad_select" class="block text-gray-800 font-medium mb-2">For which
                                    ad?</label>
                                <select id="ad_select" name="ad_id"
                                    class="block w-full rounded-md border-gray-300 shadow-sm p-2">
                                    @foreach ($ads as $ad)
                                        <option value="{{ $ad->id }}">{{ $ad->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="text" name="name" id="name" placeholder="Your Name..."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <input type="text" name="bankaccount" id="bankaccount"
                                placeholder="Your bank account number..."
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <div class="flex items-center">
                                <input type="checkbox" name="accept_terms" id="accept_terms" class="mr-2" required>
                                <span class="text-gray-600">I agree to the <a href="#"
                                        class="text-blue-500 hover:underline">terms &
                                        conditions</a></span>
                            </div>
                            <button type="submit" class="mt-4 p-2 bg-blue-500 text-white rounded btn-premium">Buy
                                Now</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
</x-layout>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector(".btn-premium").addEventListener('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: "Are you sure you want to pay for premium?",
                text: "You are trying to buy premium for {{ $ad->title }} This will cost you €10",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, I want my ad on the top!"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("buyPremiumForm").submit();
                }
            });
        });
    });
</script>
