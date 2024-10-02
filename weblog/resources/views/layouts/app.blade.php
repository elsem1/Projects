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
	<body>
		
		<!-- header -->
		
		@include('components.partials.header')
		
		<!-- /header -->
		
		<!-- nav -->
		@include('components.partials.nav')
		<!-- /nav -->
		<div class="w-full h-full bg-neutral-950">
		
		
		

			<!-- title -->
			<!-- /title -->
			
			
			
			<!-- /blog -->
			<div class="container max-w-4xl mx-auto md:flex items-start py-8 px-12 md:px-0">
				<div class="w-full md:pr-12 mb-12">
			@yield('content')
				</div>
			</div>
			
		<!-- /blog -->
		<!-- sidebar -->
		<div class="w-full md:w-64 md:sticky md:top-8">
			@include('components.partials.sidebar')
		</div>
		<!-- /sidebar -->

		<!-- footer -->
		@include('components.partials.footer')
		<!-- /footer -->


	</body>
</html>