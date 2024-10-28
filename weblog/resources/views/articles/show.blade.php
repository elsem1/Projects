<x-layout>
    <x-slot:heading>
        Blog Post
    </x-slot:heading>

    
    <div class="article">
        <h2 class="text-gray-200 text-xl md:text-2xl">{{ $article->title }}</h2>
        <p class="mt-10 text-zinc-400 leading-normal">{{ $article->body }}</p>        
    </div>
    @include('components.comments-box')
</x-layout>


