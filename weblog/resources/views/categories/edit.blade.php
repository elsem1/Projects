<x-layout>
    <x-slot:heading>
        Edit Category
    </x-slot:heading>

    <div class="max-w-3xl mx-auto py-8 px-4">
        <h1 class="text-2xl md:text-4xl pb-6 text-slate-400 text-center">Edit {{ $category->name }} Category</h1>

        <form method="POST" action="{{ route('categories.update', $category->id) }}" class="space-y-12">
            @csrf
            @method('PATCH')

            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-zinc-400">Category Details</h2>
                <p class="mt-1 text-sm leading-6 text-blue-50">Please update the information below.</p>

                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 md:grid-cols-2">
                    <x-form-field>
                        <x-form-label for="name">Name</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" id="name" name="name" value="{{ $category->name }}" required class="w-full" />
                            <x-form-error name="name"/>
                        </div>
                    </x-form-field>

                    <x-form-field>
                        <x-form-label for="description">Description</x-form-label>
                        <div class="mt-2">
                            <textarea id="description" name="description" rows="3" class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                {{ $category->description }}
                            </textarea>
                            <x-form-error name="description"/>
                        </div>
                </div>
            </div>
                
                <div class="mt-6 flex items-center justify-end gap-x-6">
                    <a href="{{ route('categories.index') }}" class="text-sm font-semibold leading-6 text-red-500">Cancel</a>
                    <x-form-button>Update Category</x-form-button>
                </div>
            </x-form-field>
        </form>
    </div>
</x-layout>