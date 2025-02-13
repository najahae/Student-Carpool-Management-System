<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class DriverManagementController extends Controller
{
    public function index()
    {
        return view('admin.driver.index'); // Or return a response
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.driver.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'gender' => 'required|string',
            'student_id' => 'required|string|unique:drivers,studentID',
            'phone' => 'required|string|max:15',
            'email' => 'required|email|unique:drivers,email',
            'password' => 'required|string|min:6',
            'student_card' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        Log::info('Validated Data', $validatedData);

        // Handle student card upload
        $studentCardPath = null;
        if ($request->hasFile('student_card')) {
            $studentCardPath = $request->file('student_card')->store('student_cards', 'public');
        }

        $licenseCardPath = null;
        if ($request->hasFile('license_card')) {
            $studentCardPath = $request->file('license_card')->store('license_card', 'public');
        }

        // Create driver
        $driver = Driver::create([
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'studentID' => $request->student_id,
            'phoneNum' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'studentCard' => $studentCardPath,
            'licenseCard' => $licenseCardPath,
        ]);

    
        Log::info('Driver Created:', $driver->toArray());

        return redirect()->route('admin.driver.index')->with('success', 'Driver added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Driver $driver)
    {
        $drivers = Driver::find($driver);
        return view('admin.driver.show', compact('drivers'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $driver = Driver::find($id);
        return view('admin.driver.edit', compact('driver'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'fullname' => 'required|string|max:255',
            'gender' => 'required|string|in:male,female,other',
            'studentID' => 'required|string|max:255|unique:drivers,studentID,' . $id . ',id',
            'phoneNum' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:drivers,email,' . $id . ',id',
            'password' => 'nullable|string|min:8|confirmed',
            'studentCard' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'licenseCard' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $driver = Driver::findOrFail($id);
    
        $data = [
            'fullname' => $request->fullname,
            'gender' => $request->gender,
            'studentID' => $request->studentID,
            'phoneNum' => $request->phoneNum,
            'email' => $request->email,
        ];
    
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }
    
        if ($request->hasFile('studentCard')) {
            $data['studentCard'] = $request->file('studentCard')->store('student_cards', 'public');
        }
    
        if ($request->hasFile('licenseCard')) {
            $data['licenseCard'] = $request->file('licenseCard')->store('license_cards', 'public');
        }
    
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
    
        $driver->update($data);
    
        return redirect()->route('admin.driver.index')->with('success', 'Driver updated successfully.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();
    
        return redirect()->route('admin.driver.index')->with('success', 'Driver deleted successfully.');
    }
    

    public function suspend($id)
{
    $driver = Driver::findOrFail($id);
    $driver->status = ($driver->status === 'active') ? 'suspended' : 'active';
    $driver->save();

    return redirect()->route('admin.driver.index')->with('success', 'Driver status updated successfully.');
}

public function verifyLicense($id)
{
    $driver = Driver::findOrFail($id);
    $driver->license_verified = true; // Assuming you have a `license_verified` column (boolean)
    $driver->save();

    return redirect()->route('admin.driver.index')->with('success', 'Driver license verified successfully.');
}

}
