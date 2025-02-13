<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Models\Passenger;

class PassengerManagementController extends Controller
{
    public function index()
    {
        return view('admin.passenger.index'); // Or return a response
        // return view('admin.passenger_management.index'); // original code
    }

    public function create()
    {
        return view('admin.passenger.create');
        // return view('admin.passenger_management.create'); // original code
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'gender' => 'required|string',
            'student_id' => 'required|string|unique:passengers,student_id',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:passengers,email',
            'password' => 'required|string|min:6',
            'student_card' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        Log::info('Validated Data', $validatedData);

        // Handle student card upload
        $studentCardPath = null;
        if ($request->hasFile('student_card')) {
            $studentCardPath = $request->file('student_card')->store('student_cards', 'public');
        }

        // Create passenger
        $passenger = Passenger::create([
            'name' => $request->fullname,
            'gender' => $request->gender,
            'student_id' => $request->student_id,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'student_card' => $studentCardPath,
        ]);

        Log::info('Passenger Created:', $passenger->toArray());

        return redirect()->route('admin.passenger.index')->with('success', 'Passenger added successfully!');
    }

    public function destroy($id)
    {
        $driver = Passenger::findOrFail($id);
        $driver->delete();
    
        return redirect()->route('admin.passenger.index')->with('success', 'Passenger deleted successfully.');
    }

    public function show($id)
    {
        $passenger = Passenger::find($id);
        return view('admin.passenger.show', compact('passenger'));
    }
}
