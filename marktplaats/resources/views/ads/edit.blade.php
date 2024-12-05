<x-layout>
    
    <div class="create-ad-page container mx-auto my-8 px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 bg-white shadow-md rounded-lg p-6">
                <form action="{{ route('ads.update', $ad->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('title', $ad->title) }}" required>
                    </div>

                    <x-add-image></x-add-image>

                    <div class="mb-4">
                        <label for="ask" class="block text-sm font-medium text-gray-700">Asking Price (€)</label>
                        <input type="number" name="ask" id="ask" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('ask', $ad->ask) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="category" class="block text-lg md:text-xl font-semibold text-slate-400">Category</label>
                        <select name="categories[]" id="category" required multiple class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ (collect(old('categories', $ad->categories->pluck('id')))->contains($category->id)) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>        
                    </div>

                    <div class="mb-4">
                        <label for="body" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="body" id="body" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="5" required>{{ old('body', $ad->body) }}</textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
                            Save Changes
                        </button>
                        <button type="button" class="ml-5 bg-red-700 text-white px-4 py-2 rounded-lg shadow hover:bg-red-500 btn-delete">
                            Delete Ad
                        </button>
                    </div>
                    
                </form>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-800">Lorem Ipsum</h2>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ route('ads.destroy', $ad->id) }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector(".btn-delete").addEventListener('click', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById("delete-form").submit();
                    }
                });
            });
        });
        </script>

</x-layout>
