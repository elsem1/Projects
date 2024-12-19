<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);


        $remember = request()->has('remember');

        // Probeer de gebruiker te authenticeren met de 'remember' optie
        if (!Auth::attempt($attributes, $remember)) {
            throw ValidationException::withMessages([
                'email' => 'Log in failed. Email and password do not match.'
            ]);
        }

        request()->session()->regenerate();
        return redirect()->route('user.profile')->with('success', 'Successfully logged in!');
    }

    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
