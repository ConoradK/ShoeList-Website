<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login form.
     *
     * This method only allows access to the login page if the user is not already logged in.
     * If the user is authenticated, they are redirected to the home page.
     *
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function showLoginForm()
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Redirect authenticated users to the home page
            return redirect()->route('home');
        }

        // Return the login view if not authenticated
        return view('auth.login');
    }

    /**
     * Handle the login request.
     *
     * This method handles form submission for login, validates the provided data,
     * and attempts to log the user in using the credentials. If successful,
     * the user is redirected to their intended destination, otherwise, an error
     * message is displayed.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Validate the input data (username and password)
        $request->validate([
            'username' => 'required|string',   // Username is required and should be a string
            'password' => 'required|string|min:6',  // Password is required and should have a minimum length of 6 characters
        ]);

        // Get the username and password from the request
        $credentials = $request->only('username', 'password');
        
        // Attempt to log the user in with the provided credentials
        if (Auth::attempt($credentials)) {
            // If successful, redirect to the intended page (default to home)
            return redirect()->intended('/');
        }

        // If login fails, redirect back with an error message
        return redirect()->back()->withErrors(['username' => 'Invalid credentials']);
    }

    /**
     * Handle the logout request.
     *
     * This method logs out the user, invalidates the session,
     * and regenerates the CSRF token to prevent session fixation attacks.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Log out the user and invalidate their session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect the user to the login page
        return redirect()->route('login');
    }
}
