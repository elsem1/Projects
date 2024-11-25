<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CarouselSlide extends Component
{
    public $id;
    public $image;
    public $title;
    public $description;
    public $link;
    public $checked;

    /**
     * Create a new component instance.
     *
     * @param int $id
     * @param string $image
     * @param string $title
     * @param string $description
     * @param string $link
     * @param bool $checked
     * @return void
     */
    public function __construct($id, $image, $title, $description, $link, $checked)
    {
        $this->id = $id;
        $this->image = $image;
        $this->title = $title;
        $this->description = $description;
        $this->link = $link;
        $this->checked = $checked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.carousel-slide');
    }
}
