<x-layout>
    <x-slot:heading>
        Blog Post
    </x-slot:heading>

    
    <div class="article">
        <h2 class="text-gray-200 text-xl md:text-2xl">{{ $article->title }}</h2>
        <h6 class="mb-4 text-sm text-blue-300">
            @foreach ($article->categories as $category)
                            <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                            @if (!$loop->last) ,  @endif 
                        @endforeach
        </h6>
        <p class="mt-10 text-zinc-400 leading-normal">{{ $article->body }}</p>        
    </div>
    @can('edit', $article) {{-- weergeeft de edit button alleen wanneer de user geauthoriseerd is, via gate in AppServiceProvider of JobPolicy --}}
    <p class="mt-6">
        <x-button href="{{ route('articles.edit', $article->id) }}"> Edit Article</x-button>
    </p>
    @endcan
    @include('components.comments-box')
</x-layout>


