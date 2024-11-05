<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CheckPremium
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Assuming you have a `is_premium` field on your User model
        if (!auth()->check() || !auth()->user()->premium) {
            // Redirect to subscription page if user is not premium
            return redirect()->route('premium');
        }

        return $next($request);
    }
}
