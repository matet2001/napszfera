<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Assuming you have an 'is_admin' column in your users table
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request);
        }

        // Redirect to a forbidden or home page if not admin
        return redirect(route('home'))->with('error', 'Unauthorized access');
    }
}

