<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Carousel extends Component
{
    public $slides;

    /**
     * Create a new component instance.
     *
     * @param array $slides
     */
    public function __construct(array $slides)
    {
        $this->slides = $slides;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.carousel');
    }
}
