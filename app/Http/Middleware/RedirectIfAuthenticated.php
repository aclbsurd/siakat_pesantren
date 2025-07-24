<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect('/dashboard'); // Admin
            }
        }

        // Ini dia: custom redirect kalau login santri/pengajar sudah aktif
        if (session()->has('santri_id')) {
            return redirect()->route('santri.jadwal');
        }

        if (session()->has('pengajar_id')) {
            return redirect()->route('pengajar.jadwal');
        }

        return $next($request);
    }
}
