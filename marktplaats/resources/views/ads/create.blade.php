<x-layout>
    <div class="create-ad-page container mx-auto my-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Form Section -->
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Images Upload -->
                    <div class="mb-4">
                        <label for="images" class="block text-sm font-medium text-gray-700">Images</label>
                        <input type="file" name="images[]" id="images" class="mt-1 block w-full" multiple>
                    </div>

                    <!-- Asking Price -->
                    <div class="mb-4">
                        <label for="ask" class="block text-sm font-medium text-gray-700">Asking Price (€)</label>
                        <input type="number" name="ask" id="ask" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                    </div>

                    <!-- Characteristics -->
                    <div class="mb-4">
                        <label for="characteristics" class="block text-sm font-medium text-gray-700">Characteristics</label>
                        <textarea name="characteristics" id="characteristics" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="3" placeholder="e.g. Condition, Color, Size, Features, Brand" required></textarea>
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="body" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="body" id="body" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="5" required></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                            Create Ad
                        </button>
                    </div>
                </form>
            </div>

            <!-- Information Section -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800">Information</h2>
                <p class="text-gray-600 mt-2">
                    Fill out the form to create a new ad. Ensure all fields are completed with accurate details. You can upload multiple images to showcase your item.
                </p>
            </div>
        </div>
    </div>
</x-layout>
