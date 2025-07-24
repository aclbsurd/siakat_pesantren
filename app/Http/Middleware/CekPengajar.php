<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CekPengajar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->session()->has('pengajar_id')) {
            return redirect()->route('login.pengajar')->with('error', 'Silakan login sebagai pengajar.');
        }

        return $next($request);
    }
}
