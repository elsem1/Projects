    
@extends('components.layout')

@section('content')

<div class="article">
    <h2 class="text-gray-200 text-xl md:text-2xl">{{ $article->title }}</h2><br><br>
    <p class="text-zinc-400 leading-normal">{{ $article->body }}</p>
   
</div>
    
@endsection



