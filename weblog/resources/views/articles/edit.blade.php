<x-layout>
    <x-slot:heading>
        Edit Article
    </x-slot:heading>

    
    <form method="POST" action="{{ route('articles.update', $article->id) }}" enctype="multipart/form-data" class="max-w-3xl mx-auto bg-neutral-900 p-8 rounded-lg shadow-lg">
        @csrf
        @method('PATCH')
        
        <h1 class="text-2xl md:text-4xl font-semibold text-slate-400 text-center mb-8">Edit Your Article</h1>
        
        
        <div class="mb-6">
            <x-form-label for="title" class="block text-lg md:text-xl font-semibold text-slate-400">Title:</x-form-label>
            <input type="text" id="title" name="title" value="{{ $article->title }}" required 
                class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
            <x-form-error name="title"/>
        </div>

        
        <div class="mb-6">
            <x-form-label for="category" class="block text-lg md:text-xl font-semibold text-slate-400">Category:</x-form-label>
            <select name="categories[]" id="category" multiple required
                class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $article->categories->contains($category->id) ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        
        <div class="mb-6">
            <x-form-label for="body" class="block text-lg md:text-xl font-semibold text-slate-400">Article:</x-form-label>
            <textarea id="body" name="body" rows="8" required 
                class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">{{ $article->body }}</textarea>
        </div>
        
        <x-add-image></x-add-image>
       
        
        <div class="mt-8 flex items-center justify-between gap-x-6">
            
            <button form="delete-form" class="text-red-500 text-sm font-bold hover:underline">Delete</button>
            
            <div class="flex items-center gap-x-6">
                
                <a href="{{ route('articles.show', $article->id) }}" class="text-sm font-semibold text-zinc-100 hover:text-zinc-200">Cancel</a>
                
                
                <button type="submit" 
                        class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                    Save Changes
                </button>
            </div>
        </div>
    </form>

    
    <form method="POST" action="{{ route('articles.destroy', $article->id) }}" id="delete-form" class="hidden">
        @csrf
        @method('DELETE')
    </form>
</x-layout>
