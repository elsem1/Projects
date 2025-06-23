<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $remember = $request->boolean('remember');

        if (!Auth::attempt($credentials, $remember)) {

            throw ValidationException::withMessages([
                'email' => 'De ingevoerde gegevens zijn ongeldig.',
            ]);
        }

        $request->session()->regenerate();
    }

    public function meRequest()
    {
        return response()->json(Auth::user());
    }
}
