@extends('components.layout')

@section('content')
    <h1 class="text-xl md:text-4xl pb-6 text-slate-400 text-center">Write a New Article</h1>
    <form action="{{ route('articles.store') }}" method="POST" class="max-w-3xl mx-auto bg-neutral-900 p-6 rounded-lg shadow-lg">
        @csrf

        <!--  This part is to add the title to a new article -->
        <div class="mb-6">
            <label for="title" class="block text-lg md:text-2xl font-semibold text-slate-400 mb-2">Title:</label>
            <input type="text" id="title" name="title" required 
                class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
        </div>

        <!--  This part is to select a category to the article -->
        <div class="mb-6">
            <label for="category" class="block text-lg md:text-2xl font-semibold text-slate-400 mb-2">Category:</label>
            <select name="category_id" id="category" required
                class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- This part is to write the article itself -->
        <div class="mb-6">
            <label for="body" class="block text-lg md:text-2xl font-semibold text-slate-400 mb-2">Article:</label>
            <textarea id="body" name="body" rows="8" required
                class="w-full px-4 py-2 rounded-lg bg-neutral-800 text-slate-200 border border-slate-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent"></textarea>
        </div>

        <!-- This is the submit button -->
        <div class="text-center">
            <button type="submit" class="px-6 py-2 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600">
                Save Article
            </button>
        </div>
    </form>
@endsection
