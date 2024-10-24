<nav class="w-full bg-neutral-950 md:pt-0 px-6 relative z-20 border-t border-zinc-200">
    <div class="container mx-auto max-w-4xl md:flex justify-between items-center text-sm md:text-md md:justify-start">
        <div class="w-full md:w-1/2 text-center md:text-left py-4 flex flex-wrap justify-center items-stretch md:justify-start md:items-start">
            
            <x-nav-link href="/" :active="request()->is('/')">Home</x-nav-link>
            <x-nav-link href="/articles" :active="request()->is('articles')">Articles</x-nav-link>
            <x-nav-link href="/profile" :active="request()->is('profile')">Profile</x-nav-link>
            <x-nav-link href="/news" :active="request()->is('news')">News</x-nav-link>
            <x-nav-link href="/contact" :active="request()->is('contact')">Contact</x-nav-link>
        </div>
        <div class="w-full md:w-1/2 text-center md:text-right">
            <a href="search" class="px-2 md:pl-0 md:mr-3 md:pr-3 text-slate-400 no-underline md:border-r border-gray-light">Search</a>
        </div>
    </div>
    
            <div class="md:w-1/2 text-center md:text-right mt-4 md:mt-0">

                @auth
                    @if (!request()->is('articles/create'))
                        <x-nav-link href="{{ route('articles.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded">
                            &#10133; New Article
                        </x-nav-link>
                @endif
            @endauth

    
    </div>
</nav>
