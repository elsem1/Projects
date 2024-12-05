<div class="ad-img">
    <img src="{{ $image ?? 'https://picsum.photos/400/400?random=1' }}" alt="{{ $title ?? 'Ad Image' }}" class="d-block w-100">
    <div class="ad-caption hidden">
        <h5>{{ $title ?? 'Default Title' }}</h5>
        <p>{{ $description ?? 'Default Description' }}</p>
        @if(!empty($link))
            <a href="{{ $link }}" class="btn btn-primary">Learn More</a>
        @endif
    </div>
</div>
