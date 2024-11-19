<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Semper Agora</title>
    
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css"/>	
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet"/>  
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>  

</head>

<body class="bg-stone-600 text-zinc-200 work-sans leading-normal text-base tracking-normal flex flex-col min-h-screen">
    <x-nav></x-nav>  

    <div class="flex-grow">
        {{ $slot }}
    </div>

    <x-footer></x-footer>
   

</body>
</html>
