


<header class="w-full px-6 bg-stone-950">
    <div class="container mx-auto max-w-4xl md:flex justify-between items-center">
        <a href="#" class=" py-6 w-full text-center md:text-left md:w-auto text-stone-400 no-underline flex justify-center items-center">
            Your Logo
        </a>
        <div class="w-full md:w-auto text-center md:text-right">
            @guest								
                <a href="/login" class="px-2 md:pl-0 md:mr-3 md:pr-3 text-stone-400 no-underline md:border-r border-stone-400">Login</a>
                <a href="/register" class="px-2 md:pl-0 md:mr-3 md:pr-3 text-stone-400 no-underline md:border-r border-stone-400">Signup</a>
            @endguest

            @auth
                <form method="POST" action="/logout">
                    @csrf
                    <x-form-button>Log Out</x-form-button>
                </form>
            @endauth


        </div>
    </div>
</header>