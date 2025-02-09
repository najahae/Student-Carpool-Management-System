<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Passenger;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;

class PassengerController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:passengers,email',
            'student_id' => 'required|unique:passengers,student_id',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required',
        ]);

        // Create the new passenger
        $passenger = Passenger::create([
            'name' => $request->name,
            'email' => $request->email,
            'student_id' => $request->student_id,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
        ]);

        // Log the passenger in after registration
        Auth::loginUsingId($passenger->id);

        return redirect()->route('passenger.home')->with('success', 'Registration successful!');
    }

    public function showRegisterForm()
    {
        return view('passenger.register');  // This is the registration form view
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        

        // Attempt to log the user in using the web guard
        if (Auth::guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {
            return redirect()->intended(route('passenger.home'));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    public function home()
    {
        return view('passenger.home');  // This is the passenger home page view
    }

    public function index()
    {
        $passengers = Passenger::all();
        return view('passenger.index', compact('passengers'));
    }

    public function create()
    {
        return view('passenger.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'student_id' => 'required',
            'password' => 'required',
            'phone' => 'required'
        ]);

        // Insert a new passenger record into the database
        DB::table('passengers')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'student_id' => $request->student_id,
            'password' => $request->password,
            'phone' => $request->phone,
        ]);

        return redirect()->route('passenger.index')->with('success', 'Passenger created successfully.');
    }

    public function show(Passenger $passenger)
    {
        return view('passenger.show', compact('passenger'));
    }

    public function edit(Passenger $passenger)
    {
        return view('passenger.edit', compact('passenger'));
    }

    public function update(Request $request, Passenger $passenger)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'student_id' => 'required',
            'phone' => 'required',
            'password' => 'nullable', // Optional, only update if provided
        ]);

        DB::table('passengers')->where('id', $request->id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'student_id' => $request->student_id,
            'phone' => $request->phone,
            'password' => $request->password ? Hash::make($request->password) : $request->password,
        ]);

        return redirect()->route('passenger.index')->with('success', 'Passenger updated successfully');
    }

    public function destroy(Passenger $passenger)
    {
        $passenger->delete();

        return redirect()->route('passenger.index')->with('success', 'Passenger deleted successfully');
    }
}
