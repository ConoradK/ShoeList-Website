<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to login page if not authenticated
            return redirect()->route('login');
        }

        // Check if the user has the 'user' role
        if (Auth::user()->role !== 'user') {
            // Redirect to home page or any other page if the user doesn't have 'user' role
            return redirect()->route('home')->with('error', 'You do not have permission to perform this action.');
        }

        // Proceed with the request if everything is fine
        return $next($request);
    }
}
