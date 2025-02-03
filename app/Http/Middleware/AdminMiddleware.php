<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;


class AdminMiddleware
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
        // Check if the user is logged in and has the role of "admin"
        if (Auth::check()) {
            // dd(Auth::user()->role);  // Dumps the role

            if (Auth::user()->role === 'admin') {
                return $next($request); // Allow access if the user is an admin
            } else {
                return redirect()->route('home')->with('error', 'You are not authorized.');
            }
        }

        // Redirect guest users to the login page
        return redirect()->route('login')->with('error', 'Please log in to continue.');
    }
}
