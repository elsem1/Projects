<x-layout>
    <x-slot:heading>
        Blog Post
    </x-slot:heading>

    <h2 class="font-bold">{{ $article->title }}</h2>
    <div class="article">
        <h2 class="text-gray-200 text-xl md:text-2xl">{{ $article->title }}</h2><br><br>
        <p class="text-zinc-400 leading-normal">{{ $article->body }}</p>
    
    </div>

</x-layout>


