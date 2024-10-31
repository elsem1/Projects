<x-layout>
    <x-slot:heading>
        Category: {{ $category->name }}
    </x-slot:heading>

    <div class="category mb-8">
        <!-- Category Header -->
        <div class="mb-4">
            <h1 class="text-3xl font-semibold text-gray-200 mb-2">{{ $category->name }}</h1>
            <p class="text-blue-300 text-sm italic">Read the latest articles about "{{ $category->name }}"</p>
        </div>

        <!-- Articles List -->
        <div class="articles-list space-y-6 mt-6">
            @foreach ($articles as $article)
                <div class="article-item p-4 rounded-lg bg-neutral-800 hover:bg-neutral-700 transition-colors duration-150 shadow-sm">
                    <h2 class="text-xl font-medium text-gray-100 mb-1">
                        <a href="{{ route('articles.show', $article->id) }}" class="hover:text-blue-400 transition-colors">{{ $article->title }}</a>
                    </h2>
                    <p class="text-sm text-slate-400 mb-2">
                        By <span class="font-semibold">{{ $article->user->name }}</span> &bull; {{ $article->created_at->format('M d, Y') }}
                    </p>
                    <p class="text-slate-300 text-sm">
                        {{ Str::limit($article->body, 100) }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</x-layout>
