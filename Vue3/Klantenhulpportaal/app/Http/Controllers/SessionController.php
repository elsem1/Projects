<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Password;
use App\Http\Resources\UserResource;
use App\Mail\SuccessfulRegistration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Console\Migrations\ResetCommand;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SessionController extends Controller
{

    public function show(User $user)
    {
        return response()->json($user);
    }

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

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        unset($validated['email_confirmation']);
        $user = User::create([
            ...$validated,
        ]);
        Mail::to($user)->send(new SuccessfulRegistration($user));
        Auth::login($user);

        return new UserResource($user);
    }


    public function meRequest()
    {
        return response()->json(Auth::user());
    }

    public function getAdmins()
    {
        $admins = User::where('is_admin', true)->get();
        return response()->json($admins);
    }

    public function forgotPassword(ForgotPasswordRequest $request)
    {

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json([
                'message' => 'Password reset link sent to your email address.'
            ], 200);
        }

        return response()->json([
            'message' => 'Unable to send password reset link.',
            'errors' => ['email' => [__($status)]]
        ], 422);
    }


    public function resetPassword(ResetPasswordRequest $request)
    {

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        if ($status === Password::PasswordReset) {
            return response()->json(['message' => 'Password reset successful'], 200);
        }

        return response()->json([
            'message' => 'Password reset failed',
            'errors' => ['email' => [__($status)]]
        ], 422);
    }




    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'Uitgelogd']);
    }
}

// Route::get('/forgot-password', function () {
//     return view('auth.forgot-password');
// })->middleware('guest')->name('password.request');
// Route::post('/forgot-password', function (Request $request) {
//     $request->validate(['email' => 'required|email']);
//     $status = Password::sendResetLink(
//         $request->only('email')
//     );
//     return $status === Password::ResetLinkSent
//         ? back()->with(['status' => __($status)])
//         : back()->withErrors(['email' => __($status)]);
// })->middleware('guest')->name('password.email');
// Route::get('/reset-password/{token}', function (string $token) {
//     return view('auth.reset-password', ['token' => $token]);
// })->middleware('guest')->name('password.reset');
// Route::post('/reset-password', function (Request $request) {
//     $request->validate([
//         'token' => 'required',
//         'email' => 'required|email',
//         'password' => 'required|min:8|confirmed',
//     ]);
//     $status = Password::reset(
//         $request->only('email', 'password', 'password_confirmation', 'token'),
//         function (User $user, string $password) {
//             $user->forceFill([
//                 'password' => Hash::make($password)
//             ])->setRememberToken(Str::random(60));
//             $user->save();
//             event(new PasswordReset($user));
//         }
//     );
//     return $status === Password::PasswordReset
//         ? redirect()->route('login')->with('status', __($status))
//         : back()->withErrors(['email' => [__($status)]]);
// })->middleware('guest')->name('password.update');