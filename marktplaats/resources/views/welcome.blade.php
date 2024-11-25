<x-layout>

<x-carousel :slides="$slides">
    @foreach ($slides as $index => $slide)
        <x-carousel-slide 
            :id="$index" 
            :image="$slide['image_url']" 
            :title="$slide['title'] ?? ''" 
            :description="$slide['description'] ?? ''"
            :link="$slide['link'] ?? null"
            :checked="$loop->first" 
        />
    @endforeach
</x-carousel>

<!-- Link to your custom CSS -->
<link rel="stylesheet" href="{{ asset('css/carousel.css') }}">



    <x-home-ads></x-home-ads>
</x-layout>
