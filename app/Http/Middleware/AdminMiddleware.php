<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login');
        }

        $role = Auth::user()->role;

        if (!in_array($role, ['admin', 'viewer'])) {
            return redirect()->route('admin.login');
        }

        if ($role === 'viewer' && !$request->routeIs('admin.dashboard')) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
