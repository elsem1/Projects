<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full flex flex-col bg-neutral-950">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Blog</title>
</head>
<body class="h-full flex flex-col bg-neutral-950">
    <!-- Header -->
    <x-header></x-header>
    
    <!-- Navigation -->
    <x-nav></x-nav>
    
    <!-- Main Content Wrapper -->
    <div class="flex-1 w-full">

        {{-- <header>
            {{ $heading }}
        </header> --}}
        <!-- Blog and Sidebar Layout -->
        <div class="container max-w-6xl mx-auto flex flex-col md:flex-row md:items-start py-8 px-4 md:px-0 md:space-x-8">
            <!-- Main Content (on the left) -->
            <div class="w-full md:flex-1">
                {{ $slot }} 
            </div>
            
            <!-- Sidebar (on the right) -->
            <div class="w-full md:w-1/4 md:sticky md:top-8">
                <x-sidebar></x-sidebar>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <x-footer></x-footer>
</body>
</html>
