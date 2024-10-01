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
		
		
		

			<!-- title -->
			<!-- /title -->
			
			
			
			
			<!-- /blog -->
			@yield('content')
			
		<!-- /blog -->


		<!-- footer -->
		@include('components.partials.footer')
		<!-- /footer -->


	</body>
</html>