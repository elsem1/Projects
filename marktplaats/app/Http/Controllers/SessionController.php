<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    if (!Auth::attempt($attributes)) {
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
