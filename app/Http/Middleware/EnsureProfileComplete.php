<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureProfileComplete
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && !auth()->user()->isProfileComplete()) {
            if (!$request->is('profile*') && !$request->is('logout')) {
                return redirect()->route('profile.edit')
                    ->with('warning', 'Silakan lengkapi profil Anda terlebih dahulu.');
            }
        }

        return $next($request);
    }
}
