@props(['id', 'image', 'title', 'description', 'link', 'checked'])

<div class="carousel-item {{ $checked ? 'active' : '' }}">
    <img src="{{ $image }}" class="d-block w-100" alt="{{ $title }}">
    <div class="carousel-caption d-none d-md-block">
        @if($title)
            <h5>{{ $title }}</h5>
        @endif
        @if($description)
            <p>{{ $description }}</p>
        @endif
        @if(!empty($link))
            <a href="{{ $link }}" class="btn btn-primary">View Product</a>
        @endif
    </div>
</div>
