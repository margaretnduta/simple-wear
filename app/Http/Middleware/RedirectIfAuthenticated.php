<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (Auth::check()) {
            $user = Auth::user();
            return redirect()->to(
                ($user && $user->is_admin)
                    ? route('admin.dashboard')
                    : route('home')
            );
        }

        return $next($request);
    }
}
