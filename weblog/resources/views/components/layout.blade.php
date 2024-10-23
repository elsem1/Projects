<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Blog</title>
</head>
<body class="bg-neutral-950">
    
    <!-- header -->
    @include('components.header')
    <!-- /header -->
    
    <!-- nav -->
    @include('components.nav')
    <!-- /nav -->
    
    <div class="w-full h-full">
        <!-- Blog and Sidebar -->
        <div class="container max-w-4xl mx-auto md:flex items-start py-8 px-12 md:px-0">

            <!-- Main content -->
            <div class="w-full md:w-3/4 md:pr-12 mb-12">
                @yield('content')
            </div>

            <!-- Sidebar -->
            <div class="w-full md:w-1/4 md:sticky md:top-8">
                @include('components.sidebar')
            </div>

        </div>
        <!-- /Blog and Sidebar -->
    </div>
    
    <!-- footer -->
    @include('components.footer')
    <!-- /footer -->

</body>
</html>
