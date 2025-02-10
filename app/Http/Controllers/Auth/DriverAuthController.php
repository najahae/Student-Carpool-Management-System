<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class DriverAuthController extends Controller
{

    /**
     * Show the driver login form.
     */
    public function showLoginForm()
    {
        //dd("Driver Login Page Reached!");
        return view('auth.driver.login');
    }

    /**
     * Handle driver login.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        \Log::info('Attempting login with credentials:', $credentials);

        if (Auth::guard('driver')->attempt($credentials)) {
            $request->session()->regenerate(); // Regenerate session to persist login
            \Log::info('Authentication successful.');
            return redirect()->route('driver.home'); // Redirect to the dashboard
        }

        \Log::info('Authentication failed.');
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the driver registration form.
     */
    public function showRegisterForm()
    {
        return view('auth.driver.register');
    }

    /**
     * Handle driver registration.
     */
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female,other', // Ensures valid gender
            'studentID' => 'required|string|max:255|unique:drivers,studentID',
            'phoneNum' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:drivers,email',
            'password' => 'required|string|min:8|confirmed',
            'studentCard' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'licenseCard' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload safely
        $studentCardPath = $request->file('studentCard')->store('student_cards', 'public');
        $licenseCardPath = $request->file('licenseCard')->store('license_cards', 'public');

        $drivers = Driver::create([
            'fullname' => $validatedData['fullname'],
            'gender' => $validatedData['gender'],
            'studentID' => $validatedData['studentID'],
            'phoneNum' => $validatedData['phoneNum'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'studentCard' => $studentCardPath,
            'licenseCard' => $licenseCardPath,
        ]);

        Auth::guard('driver')->login($drivers);

        return redirect()->route('driver.login')->with('success', 'Registration successful.');
    }

    /**
     * Handle driver logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('driver')->logout();

        // Invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('welcome')->with('success', 'Logged out successfully.');
    }

    public function __construct()
    {
        $this->middleware('guest:driver')->except('logout');
    }

}
