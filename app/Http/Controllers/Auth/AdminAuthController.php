<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    /**
     * Show the passenger login form.
     */
    public function showLoginForm()
    {
        //dd("Passenger Login Page Reached!");
        return view('auth.admin.login');
    }

    /**
     * Handle passenger login.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        \Log::info('Attempting login with credentials:', $credentials);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate(); // Regenerate session to persist login
            \Log::info('Authentication successful.');
            return redirect()->route('admin.dashboard'); // Redirect to the dashboard
        }

        \Log::info('Authentication failed.');
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the passenger registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.admin.register');
    }

    /**
     * Handle passenger registration.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:passengers,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admins = Admin::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        Auth::guard('admin')->login($admins);

        return redirect()->route('admin.login')->with('success', 'Registration successful.');
    }



    /**
     * Handle passenger logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Logged out successfully.');
    }

    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

}
