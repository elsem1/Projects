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
    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');
        $query = $request->input('query');
        $adsQuery = Ad::query();

        if ($query) { // Query voor search, zoekt in title en body
            $adsQuery->where(function ($queryBuilder) use ($query) {
                $queryBuilder->where('title', 'like', "%{$query}%")
                    ->orWhere('body', 'like', "%{$query}%");
            });
        }
        if ($categoryId) { // Query voor category, waarna alleen die category getoond wordt
            $adsQuery->whereHas('categories', function ($query) use ($categoryId) {
                $query->where('categories.id', $categoryId);
            });
        }
        // TODO: vraag: zijn de raw queries noodzakelijk?
        // Query voor alle ads waar premium als eerst getoont wordt
        $adsQuery->leftJoin('premium_history', 'ads.id', '=', 'premium_history.ad_id')
            ->select('ads.*')
            ->orderByRaw(
                "CASE 
                WHEN premium_history.purchased_at IS NOT NULL 
                    AND premium_history.purchased_at > NOW() - INTERVAL premium_history.duration_days DAY 
                THEN 0 
                ELSE 1
            END, ads.views DESC, 
            ads.created_at DESC"
            );

        $ads = $adsQuery->paginate(10);

        $categories = Category::all();

        return view('ads.index', compact('ads', 'categories', 'categoryId', 'query'));
    }


    public function show(Ad $ad)
    {
        // Laad de biedingen bij iedere ad
        $ad = Ad::with([
            'bids' => function ($query) {
                $query->orderBy('created_at', 'asc')->take(5);
            }
        ])->findOrFail($ad->id);

        // verhoogd de view counter
        $ad->increment('views');


        return view('ads.show', compact('ad'));
    }
    public function create()
    {
        $categories = Category::all();

        return view('ads.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // TODO: validation rules in aparte form request validator class zetten
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'categories' => 'array',
            'categories.*' => ['integer', 'exists:categories,id'],
            'body' => ['required', 'min:3', 'max:255'],
            'ask' => ['required', 'min:0', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // TODO: data die je in een insert query gebruikt nooit uit de ongesanitisde request data halen
        $ad = Ad::create([
            'title' => $request->title,
            'body' => $request->body,
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

        return redirect()->route('ads.show', ['ad' => $ad->id])->with('success', 'Ad created successfully.');
    }

    public function slideShow()
    {
        $slides = [
            [
                'image' => "https://images.unsplash.com/photo-1422190441165-ec2956dc9ecc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80",
                'title' => "Stripy Zig Zag Jigsaw Pillow and Duvet Set",
                'description' => "A modern set to update your bedroom",
                'link' => "#",

            ],
            [
                'image' => "https://images.unsplash.com/photo-1533090161767-e6ffed986c88?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80",
                'title' => "Real Bamboo Wall Clock",
                'description' => "Eco-friendly bamboo wall clock for your home",
                'link' => "#",

            ],
            [
                'image' => "https://images.unsplash.com/photo-1519327232521-1ea2c736d34d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1600&q=80",
                'title' => "Brown and blue hardbound book",
                'description' => "A great read for book lovers",
                'link' => "#",

            ]
        ];

        return view('welcome', compact('slides'));
    }

    public function edit(Ad $ad)
    {
        $categories = Category::all();
        $images = $ad->images;

        if (!Auth::user()->can('edit', $ad)) {
            abort(403, 'Unauthorized action.');
        }

        return view('ads.edit', [
            'ad' => $ad,
            'categories' => $categories,
            'images' => $images,
        ]);
    }

    public function update(Request $request, Ad $ad)
    {
        $request->validate([
            'title' => ['required', 'min:3', 'max:255'],
            'categories' => 'array',
            'categories.*' => ['integer', 'exists:categories,id'],
            'body' => ['required', 'min:3', 'max:255'],
            'ask' => ['required', 'min:0', 'numeric'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $request->validate([
                'image' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
                'name' => ['required', 'string', 'max:255'],
                'description' => ['required', 'string', 'max:1000'],
            ]);
        }

        $ad->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'ask' => $request->input('ask'),
            'bought_premium' => $request->input('bought_premium', 0)
        ]);

        $ad->categories()->sync($request->input('categories', []));

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $image = new Image();
            $image->ad_id = $ad->id;
            $image->name = $request->input('name');
            $image->description = $request->input('description');
            $image->path = 'images/' . $imageName;
            $image->user_id = Auth::id();
            $image->save();
        }

        return redirect()->route('ads.show', ['ad' => $ad->id])->with('success', 'Ad updated successfully.');
    }

    public function buyPremium(Request $request)
    {
        $adId = $request->input('ad_id');
        $ad = Ad::findOrFail($adId);
        // Maakt een nieuwe record in de premium_history tabel
        $ad->premiumHistory()->create([
            'purchased_at' => now(),
            'duration_days' => 1,
        ]);

        // Haalt alle premium ads op
        $premiumAds = Ad::whereHas('premiumHistory', function ($query) {
            $query->where('purchased_at', '>', now()->subDays(1));
        })->orderByDesc(function ($query) {
            $query->select('purchased_at')
                ->from('premium_history')
                ->whereColumn('ad_id', 'ads.id')
                ->orderByDesc('purchased_at')
                ->limit(1);
        })->get();

        return redirect()->route('ads.show', ['ad' => $ad->id])->with('success', 'Premium purchased successfully.');
    }


    public function destroy(Ad $ad)
    {
        $ad->delete();

        return redirect()->route('profile');
    }

}



