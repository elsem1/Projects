<!-- resources/views/components/carousel-slide.blade.php -->
@props(['id', 'image', 'title', 'description', 'link', 'checked'])

<input class="carousel-open" type="radio" id="carousel-{{ $id }}" name="carousel" aria-hidden="true" hidden {{ $checked ? 'checked' : '' }}>
<div class="carousel-item absolute opacity-0 {{ $checked ? 'active' : '' }}" style="height:50vh;">
    <div class="block h-full w-full mx-auto pt-6 md:pt-0 md:items-center bg-cover bg-center" style="background-image: url('{{ $image }}');">
        <div class="container mx-auto">
            <div class="flex flex-col w-full lg:w-1/2 md:ml-16 items-center md:items-start px-6 tracking-wide">
                @if($title)
                    <p class="text-black text-2xl my-4">{{ $title }}</p>
                @endif
                @if($description)
                    <p class="text-black text-lg mb-4">{{ $description }}</p>
                @endif
                @if (!empty($link))
                    <a class="text-xl inline-block no-underline border-b border-gray-600 leading-relaxed hover:text-black hover:border-black" href="{{ $link }}">View Product</a>
                @endif
            </div>
        </div>
    </div>
</div>
