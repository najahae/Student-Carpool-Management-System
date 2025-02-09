<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\User;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $car = Car::with('user')
        ->get();
        //dd($car);
        return view('vehicle.index',compact('car'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $car = Car::with('user');

        $user = User::pluck('fullname', 'id');

        return view('vehicle.create', compact('user', 'car'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'carImage' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $carImagePath = $request->file('carImage')->store('car_images', 'public');

        Car::create([
            //'user_id' => auth()->user()->id,
            'driverID' => $request->user_id,
            'carType' => $request->carType,
            'carModel' => $request->carModel,
            'carColor' => $request->carColor,
            'carPlate' => $request->carPlate,
            'carCapacity' => $request->carCapacity,
            'carImage' => $carImagePath,
            'roadtaxExp' => $request->roadtaxExp,
           ]);
      
        return redirect()->route('vehicle.index')
            ->with('success','Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('vehicle.show',compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $user = User::pluck('fullname', 'id');

        return view('vehicle.edit',compact('user', 'car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate([
        'carType' => 'required|string|max:255',
        'carModel' => 'required|string|max:255',
        'carColor' => 'required|string|max:255',
        'carPlate' => 'required|string|max:20',
        'carCapacity' => 'required|integer|min:1',
        'roadtaxExp' => 'required|date',
        'carImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $data = $request->all();

    // Handle image upload if a new image is provided
    if ($request->hasFile('carImage')) {
        $data['carImage'] = $request->file('carImage')->store('car_images', 'public');
    }

    $car->update($data);

    return redirect()->route('vehicle.index')->with('success', 'Vehicle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
  
        return redirect()->route('vehicle.index')
                        ->with('success','Vehicle deleted successfully');
    }
}
