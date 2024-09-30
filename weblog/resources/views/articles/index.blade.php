@extends('layouts.app')
    <h1>Articles</h1>
@section('title', 'Page Title')

@section('content')
   @foreach($articles as $article)
   <article class="mb-12">
    <h2 class="mb-4">
        <a href="#" class="text-black text-xl md:text-2xl no-underline hover:underline">
            {{ $article->itle }}
        </a>
    </h2>

    <div class="mb-4 text-sm text-gray-700">
        by <a href="#" class="text-gray-700">{{ $article->$user_id->name }}</a> on {{ $article->created_at}}
        <span class="font-bold mx-1"> | </span>
        <a href="#" class="text-gray-700">Uncategorised</a>
        <span class="font-bold mx-1"> | </span>
        <a href="#" class="text-gray-700">2 Comments</a>
    </div>

    <p class="text-gray-700 leading-normal">
        {{ $article->body }}
    </p>

</article>
@endsection