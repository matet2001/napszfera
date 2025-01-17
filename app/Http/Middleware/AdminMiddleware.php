<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!optional(Auth::user())->is_admin) {
            // Return a 403 response for unauthorized access
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}


