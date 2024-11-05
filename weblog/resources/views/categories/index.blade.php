<x-layout>
    <x-title> 
        <x-slot:title> 
            Browse Categories
        </x-slot:title> 
        <x-slot:description> 
            View articles by category
        </x-slot:description> 
    </x-title>
    <div class="max-w-3xl mx-auto py-8 px-4">
        <div class="bg-neutral-950 rounded-lg shadow-md p-6">
            <ul class="space-y-6">
                @foreach($categories as $category)
                   
                    <li class="category-item p-4 rounded-lg bg-neutral-950 border border-slate-500 hover:bg-neutral-700 transition-colors duration-150 shadow-sm flex justify-between items-center">
                        <a href="{{ route('categories.show', $category->id) }}" class="block flex-grow text-lg font-medium text-slate-200">
                            {{ $category->name }}
                        </a>  
                        <div class="text-s italic text-slate-100">
                            {{ $category->description }}
                        </div>
                                         
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-green-500 hover:text-green-400 underline ml-4">
                            Edit
                        </a>
                    </li>
                @endforeach

                <li class="mt-6 text-center">
                    <a href="{{ route('categories.create') }}" class="text-lg font-bold text-purple-300 hover:text-purple-400 underline">Add New Category</a>
                </li>
            </ul>
        </div>
    </div>
</x-layout>
