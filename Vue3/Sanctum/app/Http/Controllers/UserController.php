<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function store()
    {
        //validatie
        $attributes = request()->validate([
            'name' => ['required'],
            'username' => ['required'],
            'email' => ['required', 'email', 'confirmed'],
            'password' => ['required', 'string', 'min:7', 'max:20', 'confirmed', 'regex:/[a-z]/', 'regex:/[A-Z]/', 'regex:/[0-9]/', 'regex:/[@$!%*#?&]/']
        ]);
        if (User::where('email', $attributes['email'])->exists()) {
            throw ValidationException::withMessages([
                'email' => 'Email already exists'
            ]);
        }
        $user = User::create($attributes);
        Auth::login($user);

        return redirect('/');
    }
}
