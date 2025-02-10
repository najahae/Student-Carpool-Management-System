<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Passenger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class PassengerAuthController extends Controller
{

    /**
     * Show the passenger login form.
     */
    public function showLoginForm()
    {
        //dd("Passenger Login Page Reached!");
        return view('auth.passenger.login');
    }

    /**
     * Handle passenger login.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        \Log::info('Attempting login with credentials:', $credentials);

        if (Auth::guard('passenger')->attempt($credentials)) {
            $request->session()->regenerate(); // Regenerate session to persist login
            \Log::info('Authentication successful.');
            return redirect()->route('passenger.dashboard'); // Redirect to the dashboard
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
        return view('auth.passenger.register');
    }

    /**
     * Handle passenger registration.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:passengers,email',
            'student_id' => 'required|string|max:255|unique:passengers,student_id',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'required|string|max:15',
        ]);

        $passengers = Passenger::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'student_id' => $validatedData['student_id'],
            'password' => Hash::make($validatedData['password']),
            'phone' => $validatedData['phone'],
        ]);

        Auth::guard('passenger')->login($passengers);

        return redirect()->route('passenger.login')->with('success', 'Registration successful.');
    }



    /**
     * Handle passenger logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('passenger')->logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Logged out successfully.');
    }

    public function __construct()
    {
        $this->middleware('guest:passenger')->except('logout');
    }

}
