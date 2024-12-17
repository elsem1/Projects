<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Events\SuccessfulRegistration;
use App\Models\Ad;

class UserController extends Controller
{
    public function index()
    {

        $ads = Auth::user()->ads()->simplePaginate(5);

        return view('user.profile', compact('ads'));
    }


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
        event(new Registered($user));
        Auth::login($user);

        return redirect('/');
    }

    public function emailVerify(EmailVerificationRequest $request)
    {
        $request->fulfill();
        SuccessfulRegistration::dispatch($request->user());

        return redirect('/');
    }

    public function notification(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with(['status' => 'Verification link sent!']);
    }

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with(['status' => 'A reset link has been sent to ' . $request->email])
            : back()->with(['status' => 'A reset link has been sent to ' . $request->email]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function updateNotifications(Request $request)
    {

        $user = Auth::user();

        // Update de notificatie checkbox
        $user->receive_notifications = $request->has('receive_notifications');
        $user->save();


        return redirect()->route('user.profile')->with('success', 'Notification settings updated.');
    }
}
