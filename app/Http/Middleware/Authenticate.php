<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Tentukan path redirect ketika user tidak terautentikasi.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        // Redirect sesuai prefix URL
        if ($request->is('santri/*')) {
            return route('login.santri');
        }

        if ($request->is('pengajar/*')) {
            return route('login.pengajar');
        }

        // Default redirect ke login admin
        return route('login.admin');
    }
}
