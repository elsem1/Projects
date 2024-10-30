<x-layout>
    <x-slot:heading>
        Create New Category
    </x-slot:heading>
    <form action="{{ route('articles.store') }}" method="POST" class="max-w-3xl mx-auto bg-neutral-900 p-6 rounded-lg shadow-lg">
        @csrf
        
        
        <div class="mb-6">
            <h1 class="text-xl md:text-4xl pb-6 text-slate-400 text-center">Write a New Article</h1>
            <x-form-label for="title">Title:</x-form-label>
            <input type="text" id="title" name="title" required 
                class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>

        
        <div class="mb-6">
            <x-form-label for="category" class="block text-lg md:text-2xl font-semibold text-slate-400 mb-2">Category:</x-form-label>
            <select name="category_id" id="category" required
                class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <a href="{{ route('categories.index') }}">Add new category</a>
        </div>
                
        <div class="mb-6">
            <x-form-label for="body" class="block text-lg md:text-2xl font-semibold text-slate-400 mb-2">Article:</x-form-label>
            <textarea id="body" name="body" rows="8" required
                class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                {{ $category->description }}</textarea>
                
                <div class="flex items-center gap-x-6">
                    <a href="{{ route('articles.index') }}" 
                    class="text-sm font-semibold leading-6 text-zinc-100">Cancel</a>
                
                    <div>
                        <button type="submit" 
                        class="px-6 py-2 md:text-right bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                        Save</button>
                    </div>


                </div>

        
    </form>
</x-layout>
