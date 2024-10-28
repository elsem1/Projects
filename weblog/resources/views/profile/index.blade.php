<x-layout>
    <x-slot:heading>
        Profile
    </x-slot:heading>

    <div class="w-full md:w-3/4 md:pr-12 mb-12">
        @foreach($articles as $article)           
                <article class="mb-12">
                    <h2 class="mb-4">
                        <a href="{{ route('articles.show', $article->id) }}" class="text-gray-200 text-xl md:text-2xl no-underline hover:underline">
                            {{ $article->title }}
                        </a>
                    </h2>
            
            <div class="mb-4 text-sm text-blue-100">
                by <a href="#">{{ $article->user->name }}</a> on {{ $article->created_at }}
                <span class="font-bold mx-1"> | </span>
                
                @if($article->categories->count())
                    <span>
                        Categor{{ $article->categories_count !== 1 ? 'ies' : 'y' }}:
                        @foreach ($article->categories as $category)
                            <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                            @if (!$loop->last), @endif 
                        @endforeach
                    </span>
                
                @else
                    
                @endif
                
                <span class="font-bold mx-1"> | </span>
                <a href="#">{{ $article->comments_count }} Comment{{ $article->comments_count !== 1 ? 's' : '' }}</a>

            </div>

            <p class="text-zinc-400 leading-normal">
                {{ $article->body }}
            </p>
        </article>
        @endforeach
        <div>
        {{-- {{ $articles->links() }} --}}
        </div>
    </div>
</x-layout>