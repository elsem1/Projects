<x-layout>
    <x-slot:heading>
        Create New Article
    </x-slot:heading>

    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto bg-neutral-900 p-8 rounded-lg shadow-lg">
        @csrf
        
        <h1 class="text-2xl md:text-4xl text-slate-400 font-semibold text-center mb-8">Write a New Article</h1>
        
        <div class="mb-6">
            <x-form-label for="title" class="block text-lg md:text-xl font-semibold text-slate-400">Title:</x-form-label>
            <input type="text" id="title" name="title" required 
                class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>

        <div class="mb-6">
            <x-form-label for="category" class="block text-lg md:text-xl font-semibold text-slate-400">Category:</x-form-label>
            <select name="categories[]" id="category" required multiple
                class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>        

        <div class="mb-6">
            <x-form-label for="body" class="block text-lg md:text-xl font-semibold text-slate-400">Article:</x-form-label>
            <textarea id="body" name="body" rows="8" required
                class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            </textarea>
        </div>

        <x-add-image></x-add-image>

        <div class="flex items-center justify-between mt-8">
            <a href="{{ route('articles.index') }}" 
               class="text-sm font-semibold text-red-500 hover:text-zinc-400">Cancel</a>
            <button type="submit" 
                    class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                Save
            </button>
        </div>
    </form>

</x-layout>
