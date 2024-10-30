<x-layout>
    <x-slot:heading>
        Manage Categories
    </x-slot:heading>

    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl md:text-4xl pb-6 text-slate-400 text-center">Manage Your Categories</h1>

        <div class="bg-gray-800 rounded-lg shadow-md p-6">
            <ul class="space-y-4">
                @foreach($categories as $category)
                    <li class="flex justify-between items-center bg-gray-700 p-4 rounded-lg">
                        <span class="text-slate-200">{{ $category->name }}</span>
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-green-500 hover:underline">Edit</a>
                    </li>
                @endforeach
                <li>
                    <a href="{{ route('categories.create') }}">Add new Category</a>
                </li>
            </ul>
        </div>
    </div>
</x-layout>
