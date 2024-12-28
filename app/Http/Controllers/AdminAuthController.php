<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // Show the login form for admin
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // Handle the login logic for admin
    public function login(Request $request)
    {
        // Validate the input data
        $credentials = $request->only('email', 'password');

        // Attempt to authenticate the admin using the provided credentials
        if (Auth::guard('admin')->attempt($credentials)) {
            // Redirect to the dashboard if authentication is successful
            return redirect()->route('dashboard.index');
        }

        // If authentication fails, return an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show the registration form for admin
    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // Handle the registration logic for admin
    public function register(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new admin account
        $admin = Admin::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => true, // Make sure the new user is an admin
        ]);

        // Log the admin in immediately after registration
        auth('admin')->login($admin);

        // Redirect to the dashboard after successful registration and login
        return redirect()->route('dashboard.index');
    }

    // Handle the logout logic for admin
    public function logout(Request $request)
    {
        // Log the admin out
        Auth::guard('admin')->logout();

        // Redirect to the admin login page
        return redirect()->route('admin.login');
    }
}
