<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller // is om nieuwe user te registeren en de input te valideren
{
    public function create()
    {
        return view('auth.register');
    }
    public function store()
    {
        // validate 
        $attributes = request()->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'max:254', 'confirmed'], // confirmed zorgt ervoor dat attributes en attributes_confirmation vergeleken worden en gelijk zijn
            'password' => ['required', Password::min(6)->max(20)->letters()->numbers()->symbols()->mixedCase(), 'confirmed']
        ]);

        //create user
        $user = User::create($attributes); // maakt de user aan in de database nadat alles gevalideerd is

        //log user in
        Auth::login($user); // met auth::login wordt de user ingelogd

        // redirect user
        return redirect('/jobs');
    }


}
