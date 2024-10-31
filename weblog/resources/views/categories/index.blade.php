<x-layout>
    <x-slot:heading>
        Manage Categories
    </x-slot:heading>

    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-3xl md:text-4xl font-semibold text-slate-400 text-center mb-6">Manage Your Categories</h1>

        <!-- Categories List -->
        <div class="bg-neutral-800 rounded-lg shadow-md p-6">
            <ul class="space-y-6">
                @foreach($categories as $category)
                    <li class="category-item p-4 rounded-lg bg-neutral-700 hover:bg-neutral-600 transition-colors duration-150 shadow-sm">
                        <div class="flex justify-between items-center">
                            <!-- Category Name -->
                            <span class="text-lg font-medium text-slate-200">
                                <a href="{{ route('categories.show', $category->id) }}">
                                    {{ $category->name }}
                                </a>
                            </span>

                            <!-- Edit Button -->
                            <a href="{{ route('categories.edit', $category->id) }}" class="text-green-500 hover:text-green-400 underline">Edit</a>
                        </div>
                    </li>
                @endforeach

                <!-- Add New Category -->
                <li class="mt-6 text-center">
                    <a href="{{ route('categories.create') }}" class="text-lg font-bold text-purple-300 hover:text-purple-400 underline">Add New Category</a>
                </li>
            </ul>
        </div>
    </div>
</x-layout>
