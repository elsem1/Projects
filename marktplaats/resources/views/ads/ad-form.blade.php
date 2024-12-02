
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if ($method === 'PUT')
        @method('PUT')
    @endif

    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('title', $ad->title ?? '') }}" required>
    </div>

    <x-add-image></x-add-image>

    <div class="mb-4">
        <label for="ask" class="block text-sm font-medium text-gray-700">Asking Price (€)</label>
        <input type="number" name="ask" id="ask" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ old('ask', $ad->ask ?? '') }}" required>
    </div>

    <div class="mb-4">
        <label for="category" class="block text-lg md:text-xl font-semibold text-slate-400">Category</label>
        <select name="categories[]" id="category" required multiple class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ (collect(old('categories', $ad->categories->pluck('id') ?? []))->contains($category->id)) ? 'selected':'' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-4">
        <label for="body" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="body" id="body" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" rows="5" required>{{ old('body', $ad->body ?? '') }}</textarea>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow hover:bg-blue-600">
            {{ $buttonText }}
        </button>
    </div>
</form>
