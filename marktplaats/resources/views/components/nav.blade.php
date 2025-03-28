<nav id="header" class="w-full z-30 top-0 py-1">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

        <label for="menu-toggle" class="cursor-pointer md:hidden block">
            <svg class="fill-current text-gray-900" width="20" height="20" viewBox="0 0 20 20">
                <title>menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />

        <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
            <nav>
                <ul class="md:flex items-center justify-between text-base text-gray-700 pt-4 md:pt-0">
                    <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="{{ route('welcome') }}">Home</a></li>
                    <li><a class="inline-block no-underline hover:text-black hover:underline py-2 px-4" href="{{ route('ads.index') }}">Shop</a></li>
                    
                </ul>
            </nav>
        </div>

        <div class="order-1 md:order-2">
            <a class="flex items-center tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
                <svg class="fill-current text-gray-800 mr-2" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M5,22h14c1.103,0,2-0.897,2-2V9c0-0.553-0.447-1-1-1h-3V7c0-2.757-2.243-5-5-5S7,4.243,7,7v1H4C3.447,8,3,8.447,3,9v11 C3,21.103,3.897,22,5,22z M9,7c0-1.654,1.346-3,3-3s3,1.346,3,3v1H9V7z M5,10h2v2h2v-2h6v2h2v-2h2l0.002,10H5V10z" />
                </svg>
                Semper Agora
            </a>
        </div>
        <div class="order-2 md:order-3 flex items-center" id="nav-content">
            @auth
            <button class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md hover:shadow-lg hover:underline transition duration-200">
                <a href="{{ route('ads.create') }}">+ Post New Ad</a>
            </button>
        @endauth
            <a class="inline-block no-underline hover:text-black" href="{{ route('user.profile') }}">
                <svg class="fill-current hover:text-black" width="24" height="24" viewBox="0 0 24 24">
                    <circle fill="none" cx="12" cy="7" r="3" />
                    <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                </svg>
            </a>
            
            
            @auth
            <form method="POST" action="{{ route('logout') }}" class="inline-block">
                @csrf
                <button type="submit" class="inline-block no-underline hover:text-black tooltip-btn" data-tooltip="Logout">
                    <svg class="fill-current hover:text-black" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M16 13v-2H7V8l-5 4 5 4v-3z"/>
                        <path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"/>
                    </svg>
                </button>
            </form>
            
            <a class="pl-3 inline-block no-underline hover:text-black" href="{{ route('messages.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="fill-current text-gray-800" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M2 4c-1.103 0-2 0.897-2 2v12c0 1.103 0.897 2 2 2h20c1.103 0 2-0.897 2-2V6c0-1.103-0.897-2-2-2H2zm0 2h20l-10 7L2 6zm0 12V8l10 7 10-7v10H2z" />
                </svg>
            </a>
                
                
            @endauth

        </div>
    </div>
</nav>
