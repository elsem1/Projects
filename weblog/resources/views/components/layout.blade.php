<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-neutral-950">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Blog</title>
</head>
<body class="h-full bg-neutral-950">
    
    <!-- header -->
    <x-header></x-header>
    <!-- /header -->
    
    <!-- nav -->
    <x-nav></x-nav>
    <!-- /nav -->
    
    <div class="w-full h-full">
        <!-- Blog and Sidebar -->
        <div class="container max-w-6xl mx-auto md:flex items-start py-8 px-12 md:px-0 space-x-8">

            <!-- Main content -->
            <div class="w-full md:w-3/4">
                {{ $slot }}  <!-- This is where your registration form will go -->
            </div>

            <!-- Sidebar -->
            <div class="w-full md:w-1/4 md:sticky md:top-8">
                <x-sidebar></x-sidebar>
            </div>

        </div>
        <!-- /Blog and Sidebar -->
    </div>
    
    <!-- footer -->
    <x-footer></x-footer>
    <!-- /footer -->

</body>
</html>
