<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth; // Added this use statement

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is NOT logged in OR if user is NOT an admin
        if (!Auth::check() || !Auth::user()->is_admin) {
            // If they are not an admin, show a 403 "Forbidden" error
            abort(403, 'STOP! You are not the Admin.');
        }

        // If they are an Admin, let them pass
        return $next($request);
    }
}
