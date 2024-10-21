<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
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
            'email' => ['required', 'email', 'max:254', 'confirmed'],
            'password' => ['required', Password::min(6)->max(20)->letters()->numbers(), 'confirmed']
        ]);
        
        //create user
        $user = User::create($attributes);

        //log user in
        Auth::login($user);

        // redirect user
        return redirect('/jobs');        
    }
    
    
}
