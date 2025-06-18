<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function create()
    {
        return view('/');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (!Auth::viaRemember($credentials, $remember)) {
            throw ValidationException::withMessages([
                'email' => 'De ingevoerde gegevens zijn ongeldig.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->intended('/')->with('success', 'Succesvol ingelogd!');
    }

    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
