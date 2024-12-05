

<div class="carousel-inner">
    @foreach($slides as $index => $slide)
        <x-carousel-slide
            :id="$index"
            :image="$slide['image']"
            :title="$slide['title']"
            :description="$slide['description']"
            :link="$slide['link']"
            :checked="$index === 0"
        />
    @endforeach
</div>

