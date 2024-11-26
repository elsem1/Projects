<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ad;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdController extends Controller
{
    public function index()
    {
        $ads = Ad::withCount('views')->latest()->simplePaginate();

        return view('ads.index', compact('ads'));
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

    public function show($id)
    {
        $ad = Ad::with(['bids' => function ($query) {
            $query->orderBy('created_at', 'asc')->take(5);
        }])->findOrFail($id);

        $ad->increment('views');

        $slides = collect(range(1, 5))->map(function ($i) {
            return [
                'id' => $i,
                'image' => "https://picsum.photos/400/400?random={$i}",
                'title' => "Random Image {$i}",
                'description' => "This is a description for Random Image {$i}",
                'link' => '#',
                'checked' => $i === 1  // Mark the first slide as active
            ];
        });

        return view('ads.show', compact('ad', 'slides'));
    }

    public function create()
    {
        return view('ads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'categories' => 'array',
            'categories.*' => ['integer', 'exists:categories,id'],
            'description' => ['required', 'min:3', 'max:255'],
            'ask' => ['required', 'min:3', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $ad = Ad::create([
            'title' => $request->title,
            'description' => $request->description,
            'ask' => $request->ask,
            'user_id' => auth()->id(),
        ]);

        $ad->categories()->sync($request->input('categories', []));

        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('images'), $imageName);

            $image = new Image();
            $image->ad_id = $ad->id;
            $image->name = $request->input('name');
            $image->description = $request->input('description');
            $image->user_id = Auth::id();
            $image->path = 'images/' . $imageName;
            $image->save();
        }

        return redirect()->route('ads.show', ['id' => $ad->id])->with('success', 'Ad created successfully.');
    }
}
