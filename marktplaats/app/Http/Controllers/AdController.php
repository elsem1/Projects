<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::withCount('views')->laterst()->simplePaginate();

        return view('ads.index', compact('ads', 'title', 'img', 'price'));
    }
    public function slideShow()
    {
        $slides = [
            [
                'image_url' => "https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80",
                'title' => "Stripy Zig Zag Jigsaw Pillow and Duvet Set",
                'description' => "A modern set to update your bedroom",
                'link' => "#"
            ],
            [
                'image_url' => "https://images.unsplash.com/photo-1533090161767-e6ffed986c88?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80",
                'title' => "Real Bamboo Wall Clock",
                'description' => "Eco-friendly bamboo wall clock for your home",
                'link' => "#"
            ],
            [
                'image_url' => "https://images.unsplash.com/photo-1519327232521-1ea2c736d34d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80",
                'title' => "Brown and blue hardbound book",
                'description' => "A great read for book lovers",
                'link' => "#"
            ]
        ];
    
        return view('welcome', compact('slides'));
    }
    

    public function show()
    {
        return view('/ads.show');
    }
    public function create() 
    {
        return view('/ads.create');
    }

    
}
