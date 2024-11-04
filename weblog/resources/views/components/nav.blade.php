<nav class="w-full bg-neutral-950 md:pt-0 px-6 relative z-20 border-t border-zinc-200">
    <div class="container mx-auto max-w-4xl md:flex justify-between items-center text-sm md:text-md md:justify-start">
        <div class="w-full md:w-1/2 text-center md:text-left py-4 flex flex-wrap justify-center items-stretch md:justify-start md:items-start">
            <x-nav-link href="/articles" :active="request()->is('articles')">Home</x-nav-link>            
            @auth                
                <x-nav-link href="/profile" :active="request()->is('profile')">My Articles</x-nav-link>
            @endauth
            <x-nav-link href="/categories" :active="request()->is('categories')">Categories</x-nav-link>
        </div>
        
        <div class="w-full md:w-1/2 text-center md:text-right mt-4 md:mt-0">
            @auth
                <!-- New Article Button -->
                @if (!request()->is('articles/create'))
                    <x-nav-link href="{{ route('articles.create') }}" 
                                class="ml-2 hover:bg-neutral-700 text-white font-medium py-2 px-4 rounded transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-neutral-600">
                        &#10133; New Article
                    </x-nav-link>
                @endif
                
                <!-- New Category Button -->
                @if (!request()->is('categories/create'))
                    <x-nav-link href="{{ route('categories.create') }}" 
                                class="ml-2  hover:bg-neutral-700 text-white font-medium py-2 px-4 rounded transition duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-neutral-600">
                        &#10133; New Category                         
                    </x-nav-link>
                @endif
            @endauth
        </div>
        
        <!-- Search Link -->
        <a href="search" 
           class="inline-block px-2 md:pl-0 md:mr-3 text-slate-400 no-underline md:border-r border-gray-400 ml-10">
           Search
        </a>
    </div>
</nav>
