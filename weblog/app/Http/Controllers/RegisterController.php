<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use App\Models\Article;

class RegisterController extends Controller
{

    public function show(Request $request)
    {
        $type = $request->query('type', 'all');
        $articles = Article::where('premium', 1)
            ->withCount(['comments', 'categories'])
            ->latest()
            ->take(2)
            ->get();
        $title = $request->query('title', 'Default Title');
        $description = $request->query('description', 'Default Description');

        return view('auth.premium', compact('title', 'description', 'articles', 'type'));
    }



    public function create()
    {
        return view('auth.register');
    }

    public function subscribeCreate()
    {
        return view('auth.subscribe');
    }

    public function store()
    {
        //validatie
        $attributes = request()->validate([
            'name' => ['required'],
            'email' => ['required', 'email', 'confirmed'],
            'password' => ['required', Password::min(7)->max(20)->letters()->numbers()->symbols()->mixedCase(), 'confirmed']
        ]);

        $user = User::create($attributes);

        Auth::login($user);

        return redirect('/articles');
    }

    public function subscribeStore(Request $request, User $user)
    {
        $request->validate([
            'premium' => 'required|boolean'
        ]);

        Auth::user()->update([
            'premium' => $request->input('premium', 0)
        ]);

        return redirect()->route('articles.premium')->with('success', 'You are now subscribed to premium content!');
    }
}
