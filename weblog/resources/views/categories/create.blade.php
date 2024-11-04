<x-layout>
    x-layout>
    <x-slot:heading>
        Create New Category 
    </x-slot:heading>
    
    <!-- Category Form -->
    <form method="POST" action="{{ route('categories.store') }}" class="max-w-3xl mx-auto bg-neutral-900 p-8 rounded-lg shadow-lg">
        @csrf

        <h1 class="text-2xl md:text-4xl text-slate-400 font-semibold text-center mb-8">Create a New Category</h1>

        
        
        <div class="mb-6">
            <x-form-label for="name" class="block text-lg md:text-xl font-semibold text-slate-400">Category Name:</x-form-label>
            <input type="text" id="name" name="name" required 
                class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                <x-form-error name="name"/>
        </div>

        
        <div class="mb-6">
            <x-form-label for="description" class="block text-lg md:text-xl font-semibold text-slate-400">Description:</x-form-label>
            <textarea id="description" name="description" rows="3" required class="w-full px-4 py-2 mt-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
            <x-form-error name="description"/>
        </div>    

        
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
