<div id="carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach($slides as $index => $slide)
            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                <img src="{{ $slide['image'] }}" class="d-block w-100" alt="{{ $slide['title'] }}">
                <div class="carousel-caption">
                    @if($slide['title'])
                        <h5>{{ $slide['title'] }}</h5>
                    @endif
                    @if($slide['description'])
                        <p>{{ $slide['description'] }}</p>
                    @endif
                    @if(!empty($slide['link']))
                        <a href="{{ $slide['link'] }}" class="btn btn-primary">View Product</a>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @if(count($slides) > 1)
        <a class="carousel-control-prev" href="#carousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    @endif
    <ol class="carousel-indicators">
        @foreach($slides as $index => $slide)
            <li data-bs-target="#carousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
        @endforeach
    </ol>
</div>




<script>
    document.addEventListener('DOMContentLoaded', () => {
        let activeSlide = 0;
        const slides = document.querySelectorAll('.carousel-item');
        const totalSlides = slides.length;

        const updateSlide = (newIndex) => {
            slides[activeSlide].classList.remove('active');
            activeSlide = newIndex;
            slides[activeSlide].classList.add('active');
        };

        document.querySelector('.carousel-control-prev').addEventListener('click', (e) => {
            e.preventDefault();
            updateSlide((activeSlide - 1 + totalSlides) % totalSlides);
        });

        document.querySelector('.carousel-control-next').addEventListener('click', (e) => {
            e.preventDefault();
            updateSlide((activeSlide + 1) % totalSlides);
        });

        document.querySelectorAll('.carousel-indicators li').forEach((bullet, index) => {
            bullet.addEventListener('click', (e) => {
                e.preventDefault();
                updateSlide(index);
            });
        });
    });
</script>

