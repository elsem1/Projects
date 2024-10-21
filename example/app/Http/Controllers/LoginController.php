<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationData;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
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
        
        if (! Auth::attempt($attributes)) 
        {
            throw ValidationException::withMessages([
                'email' => 'Sorry, those credentials do not match.'
            ]);
        }

        request()->session()->regenerate();

        return redirect('/jobs');
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/login');
    }
}
