<x-layout>
     <x-slot:heading>
        Articles
    </x-slot:heading>
        
        <div class="max-w-3xl mx-auto py-8 px-4">
            <h1 class="text-3xl md:text-4xl font-semibold text-slate-400 text-center mb-6">My Articles</h1>
    
        </div>

    <div class="w-full md:w-3/4 md:pr-12 mb-12">
        @foreach($articles as $article)
        <article class="mb-12 p-4 bg-neutral-900 rounded-lg shadow-lg">
            <h2 class="mb-4">
                <a href="{{ route('articles.show', $article->id) }}" class="text-gray-200 text-xl md:text-2xl no-underline hover:underline">
                    {{ $article->title }}
                </a>
            </h2>

            <div class="mb-4 text-sm text-blue-100">
                by <a href="#" class="text-blue-400 hover:underline">{{ $article->user->name }}</a> 
                {{ $article->created_at->diffForHumans() }}
                <span class="font-bold mx-1"> | </span>
                
                @if($article->categories->count())
                    <span>
                        Categor{{ $article->categories_count !== 1 ? 'ies' : 'y' }}:
                        @foreach ($article->categories as $category)
                            <a href="{{ route('categories.show', $category->id) }}" class="text-blue-400 hover:underline">{{ $category->name }}</a>
                            @if (!$loop->last), @endif 
                        @endforeach
                    </span>
                @endif

                <span class="font-bold mx-1"> | </span>
                <a href="#" class="text-blue-400 hover:underline">{{ $article->comments_count }} Comment{{ $article->comments_count !== 1 ? 's' : '' }}</a>
            </div>

            <p class="text-zinc-400 leading-normal">
                {{ $article->body }}
            </p>
        </article>
        @endforeach
        
       
    </div>
</x-layout>