<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekSantri
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan session santri_id ada
        if (!session()->has('santri_id')) {
            return redirect()->route('login.santri')->with('error', 'Silakan login sebagai santri.');
        }

        return $next($request);
    }
}
