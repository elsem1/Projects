<!-- resources/views/components/carousel.blade.php -->
<div class="carousel relative container mx-auto" style="max-width:1600px;">
    <div class="carousel-inner relative overflow-hidden w-full">
        {{ $slot }}
    </div>
    
    <!-- Controls -->
    @foreach ($slides as $index => $slide)
        <label for="carousel-{{ ($index - 1 + count($slides)) % count($slides) }}" 
               class="prev control control-{{ $index }} w-10 h-10 ml-2 md:ml-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 left-0 my-auto">
            ‹
        </label>
        <label for="carousel-{{ ($index + 1) % count($slides) }}" 
               class="next control control-{{ $index }} w-10 h-10 mr-2 md:mr-10 absolute cursor-pointer hidden text-3xl font-bold text-black hover:text-white rounded-full bg-white hover:bg-gray-900 leading-tight text-center z-10 inset-y-0 right-0 my-auto">
            ›
        </label>
    @endforeach

    <!-- Indicators -->
    <ol class="carousel-indicators">
        @foreach ($slides as $index => $slide)
            <li class="inline-block mr-3">
                <label for="carousel-{{ $index }}" class="carousel-bullet cursor-pointer block font-size-2rem text-gray-400 hover:text-gray-900">•</label>
            </li>
        @endforeach
    </ol>
</div>
