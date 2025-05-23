<x-layout>
    <x-title>
        <x-slot:title>
            {{ $category->name }}
        </x-slot:title>
        <x-slot:description>
            Read the latest articles about {{ $category->name }}
        </x-slot:description>
    </x-title>
    <div class="category mb-8">
        <div class="mb-4">
            <p class="text-blue-300 text-m italic">{{ $category->name}} is all about {{ $category->description }}</p>
        </div>
    </div>

    <div class="container mx-auto max-w-4xl">
        <div class="w-full md:w-3/4 md:pr-12 mb-12 mx-auto">
            <div class="articles-list space-y-6 mt-6">
                @foreach($articles as $article)
            <article class="mb-4 p-4 bg-neutral-950 rounded-lg shadow-lg border border-slate-300">
                @if($article->premium)
                    <div class="flex justify-between items-center mb-2">
                        <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-amber-500 text-yellow-800">
                            <i class="fas fa-star mr-1" style="color: gold;"></i> Premium Content
                        </span>
                        @nonpremium
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-sm font-medium bg-red-500">
                            <i class="fas fa-lock"></i>
                        </span>
                        @endnonpremium
                    </div>
                    @endif
                    <h2 class="mb-4">
                        @if($article->premium && auth()->user()->premium)
                            <a href="{{ route('articles.show', $article->id) }}" class="text-gray-200 text-xl md:text-2xl no-underline hover:underline">
                                {{ $article->title }}
                            </a>
                        @elseif (!$article->premium)
                        <a href="{{ route('articles.show', $article->id) }}" class="text-gray-200 text-xl md:text-2xl no-underline hover:underline">
                            {{ $article->title }}
                        </a>
                        @else
                        <a href="#" class="text-gray-200 text-xl md:text-2xl no-underline">
                            {{ $article->title }}
                        </a>
                        @endif

                <div class="mb-4 text-sm text-blue-100">
                    by <a href="#" class="text-blue-400 hover:underline">{{ $article->user->name }}</a> 
                    {{ $article->created_at->diffForHumans() }}
                    
                    <span class="font-bold mx-1"> | </span>
                    <a href="#" class="text-blue-400 hover:underline">{{ $article->comments_count }} Comment{{ $article->comments_count !== 1 ? 's' : '' }}</a>
                </div>

                <p class="text-zinc-400 leading-normal break-words">
                    {{ Str::limit($article->body, 500, '...') }}
                </p>
            </article>
            @endforeach
            
                <div class="mt-6">
                    {{ $articles->links() }} 
                </div>
            </div>
        </div>
    </div>
</x-layout>
