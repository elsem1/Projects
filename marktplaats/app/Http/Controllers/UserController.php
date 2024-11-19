<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;



class UserController extends Controller
{
    public function index()
    {
            return view('/user.profile');

        }

        public function store()
    {
        //validatie
        $attributes = request()->validate([
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email', 'confirmed'],
            'password' => ['required', Password::min(7)->max(20)->letters()->numbers()->symbols()->mixedCase(), 'confirmed']
        ]);
        if (User::where('email', $attributes['email'])->exists()) {
            throw ValidationException::withMessages([
                'email' => 'Email already exists'
            ]);
        }
        $user = User::create($attributes);
        event(new Registered($user));
        Auth::login($user);

        return redirect('/user.profile');
    }


}
