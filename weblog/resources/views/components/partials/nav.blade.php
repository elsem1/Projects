

<nav class="w-full bg-neutral-950 md:pt-0 px-6 relative z-20 border-t border-zinc-200">
    <div class="container mx-auto max-w-4xl md:flex justify-between items-center text-sm md:text-md md:justify-start">
        <div class="w-full md:w-1/2 text-center md:text-left py-4 flex flex-wrap justify-center items-stretch md:justify-start md:items-start">
            
            <x-partials.nav-link href="/" :active="request()->is('/')">Home</x-partials.nav-link>
            <x-partials.nav-link href="/articles" :active="request()->is('articles')">Articles</x-partials.nav-link>
            <x-partials.nav-link href="/profile" :active="request()->is('profile')">Profile</x-partials.nav-link>
            <x-partials.nav-link href="/news" :active="request()->is('news')">News</x-partials.nav-link>
            <x-partials.nav-link href="/contact" :active="request()->is('contact')">Contact</x-partials.nav-link>
        </div>
        <div class="w-full md:w-1/2 text-center md:text-right">						
            <a href="search" class="px-2 md:pl-0 md:mr-3 md:pr-3 text-slate-400 no-underline md:border-r border-gray-light">Search</a>
        </div>
    </div>
</nav>

