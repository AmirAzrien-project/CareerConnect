<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectBasedOnRole
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Check the user's role and redirect accordingly
            if (Auth::user()->type === 1) {
                return redirect()->route('dashboard'); // User dashboard
            } elseif (Auth::user()->type === 2) {
                return redirect()->route('adminDashboardShow'); // Admin dashboard
            } elseif (Auth::user()->type === 3) {
                return redirect()->route('alumni.index'); // Alumni index
            }
        }

        return $next($request);
    }
}
