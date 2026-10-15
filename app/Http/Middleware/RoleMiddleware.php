<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        $allowed = false;
        if ($role === 'user' || $role === 'student') {
            $allowed = ($user->role === 'user' || $user->role === 'student');
        } else {
            $allowed = ($user->role === $role);
        }

        if (!$allowed) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
