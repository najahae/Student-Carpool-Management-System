<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PassengerAuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.passenger.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if (Auth::guard('passenger')->attempt($credentials)) {
            return redirect()->route('passenger.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    /**
     * Show the registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.passenger.register');
    }

    /**
     * Handle registration request.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email',
            'student_id' => 'required|string|unique:passengers,student_id',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|min:10',
        ]);

        // Create Passenger
        $passenger = Passenger::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'student_id' => $validatedData['student_id'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
        ]);

        return redirect()->route('auth.passenger.login')->with('success', 'Registration successful. Please log in.');
    }

    /**
     * Logout the passenger.
     */
    public function logout()
    {
        Auth::guard('passenger')->logout();
        return redirect()->route('auth.passenger.login')->with('success', 'You have been logged out.');
    }
}
