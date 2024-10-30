<x-layout>
    <x-slot:heading>
        Edit Article
    </x-slot:heading>
    <form method="POST" action="{{ route('articles.update', $article->id) }}" class="max-w-3xl mx-auto bg-neutral-900 p-6 rounded-lg shadow-lg">
        @csrf
        @method('PATCH')
        
        <h1 class="text-xl md:text-4xl pb-6 text-slate-400 text-center">Edit your article</h1>        
        <div class="mb-6">
            <x-form-label for="title">Title:</x-form-label>
            <input type="text" id="title" name="title" value="{{ $article->title }}" required 
                class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>
        <x-form-error name="title"/>

        
        <div class="mb-6">
            <label for="category" class="block text-lg md:text-2xl font-semibold text-slate-400 mb-2">Category:</label>
            <select name="category_id" id="category" required
                class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <div class="mb-6">
                <a href="{{ route('categories.index') }}">Add new category</a>
            </div>
        </div>

        
        <div class="mb-6">
            <label for="body" class="block text-lg md:text-2xl font-semibold text-slate-400 mb-2">Article:</label>
            <textarea id="body" name="body" rows="8" value="" required 
                class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $article->body }}</textarea>
        </div>

                    
        
            
        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div class="flex items-center">
                <button form="delete-form" class="text-red-500 text-sm font-bold">
                Delete</button>
            </div>
            <div class="flex items-center gap-x-6">
                <a href="{{ route('articles.show', $article->id) }}" 
                class="text-sm font-semibold leading-6 text-zinc-100">Cancel</a>
                <div>
                    <button type="submit" 
                    class="px-6 py-2 md:text-right bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                    Save Changes</button>
                </div>
            </div>
        </div>
            
    </form>
    <form method="POST" action="/articles/{{ $article->id }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE') <!-- Zorgt ervoor dat in de patch form een delte gebruikt kan worden omdat de delete button hieraan gelinkt is -->
      </form>
</x-layout>