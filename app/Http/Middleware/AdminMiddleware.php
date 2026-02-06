<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth; // ← Pastikan ada ini
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            return redirect('/');
        }

        // Check if admin has passed 2FA
        if (!session()->has('admin_2fa_verified') && !$request->routeIs('admin.verify-pin')) {
            return redirect()->route('admin.verify-pin');
        }

        return $next($request);
    }
}