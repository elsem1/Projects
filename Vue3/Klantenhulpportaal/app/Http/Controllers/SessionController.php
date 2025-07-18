<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function authenticate(LoginRequest $request)
    {

        $credentials = $request->only('email', 'password');


        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => 'De ingevoerde gegevens zijn ongeldig.',
            ]);
        }

        $request->session()->regenerate();

        return response()->json(Auth::user());
    }

    public function meRequest()
    {
        return response()->json(Auth::user());
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'Uitgelogd']);
    }
}
