<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('/')) {
            if (Auth::check()) {
                $user = Auth::user();

                return redirect()->intended(match ($user->role->level) {
                    1 => route('dashboard.superadmin'),
                    2 => route('dashboard.admin'),
                    default => route('dashboard.user'),
                });
            }

            return redirect('/dashboard');
        }

        return $next($request);
    }
}
