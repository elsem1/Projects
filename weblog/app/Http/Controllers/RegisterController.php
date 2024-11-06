<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{

    public function show(Request $request)
{
    \Log::info('Title from query: ' . $request->query('title'));
    \Log::info('Description from query: ' . $request->query('description'));

    $title = $request->query('title', 'Default Title');
    $description = $request->query('description', 'Default Description');

    return view('auth.premium', compact('title', 'description'));
}






    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        //validatie
        $attributes = request()->validate([
            'name' => ['required'],
            'email'=> ['required', 'email', 'confirmed'],
            'password'=> ['required', Password::min(7)->max(20)->letters()->numbers()->symbols()->mixedCase(),'confirmed']
            ]);

            $user = User::create($attributes);

            Auth::login($user);

            return redirect('/');
    }
}
