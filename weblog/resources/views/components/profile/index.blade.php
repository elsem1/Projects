

@extends('layouts.app')


@section('content')


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
            <span>Categories: 
                @foreach ($article->categories as $category)
                    <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                    @if (!$loop->last), @endif 
                @endforeach
            </span>
        @else
            
        @endif
        
        <span class="font-bold mx-1"> | </span>
        <a href="#">{{ $article->comments_count }} Comments</a>
    </div>

    <p class="text-zinc-400 leading-normal">
        {{ $article->body }}
    </p>
</article>
@endforeach
{{ $articles->links() }}


@endsection