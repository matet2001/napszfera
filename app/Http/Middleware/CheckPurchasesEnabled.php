<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;

class CheckPurchasesEnabled
{
    public function handle($request, Closure $next)
    {
        $setting = Setting::first();

        if (!$setting->purchase_enabled) {
            return redirect()->route('home')->with('error', 'A vásárlások jelenleg le vannak tiltva.');
        }

        return $next($request);
    }
}

