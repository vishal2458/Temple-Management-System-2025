<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login'); // Redirect if not logged in
        }

        $user = Auth::user();

        if ($user->is_admin) {
            return redirect()->route('admin.dashboard'); // Redirect admin to admin dashboard
        } else {
            return redirect()->route('user.dashboard'); // Redirect user to user dashboard
        }

        return $next($request);
    }
}
