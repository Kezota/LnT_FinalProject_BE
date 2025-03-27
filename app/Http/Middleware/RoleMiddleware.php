<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Check which role is being requested
        if ($role === 'admin' && Auth::guard('admin')->check()) {
            return $next($request);
        } elseif ($role === 'user' && Auth::guard('user')->check()) {
            return $next($request);
        }

        return redirect()->route('login')->with('error', 'You do not have access to this page.');
    }
}
