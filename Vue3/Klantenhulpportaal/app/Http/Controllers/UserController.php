<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Mail\SuccessfulRegistration;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::all());
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

    public function show(User $user)
    {
        if (!Auth::user()->is_admin && Auth::id() !== $user->id) {
            abort(403, 'Unauthorized');
        }

        return new UserResource($user);
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

    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        $user->update($validated);

        return new UserResource($user);
    }

    public function destroy(User $user)
    {
        if ($user->createdTickets()->whereIn('status_id', ['1', '2', '3'])->exists()) {
            return response()->json([
                'message' => 'Cannot delete user. User still has active Ticket(s).'
            ], 422);
        }
        $user->delete();
        return response()->noContent();
    }
}
