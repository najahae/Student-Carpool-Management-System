<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Models\Driver;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $car = Car::with('driver')
        ->get();
        //dd($car);
        return view('driver.vehicle.index',compact('car'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $car = Car::with('driver');

        $driver = Driver::pluck('studentID', 'id');

        return view('driver.vehicle.create', compact('driver', 'car'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'driverID' => 'required|exists:drivers,id',
            'carImage' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        $carImagePath = $request->file('carImage')->store('car_images', 'public');
        
        Car::create([
            'driverID' => $request->driverID,
            'carType' => $request->carType,
            'carModel' => $request->carModel,
            'carColor' => $request->carColor,
            'carPlate' => $request->carPlate,
            'carCapacity' => $request->carCapacity,
            'carImage' => $carImagePath,
            'roadtaxExp' => $request->roadtaxExp,
           ]);
      
        return redirect()->route('driver.vehicle.index')
            ->with('success','Vehicle created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return view('driver.vehicle.show',compact('car'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $driver = Driver::pluck('studentID', 'id');

        return view('driver.vehicle.edit',compact('driver', 'car'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $car->update($request->all());

        $data = $request->all();

        // Handle image upload if a new image is provided
        if ($request->hasFile('carImage')) {
            $data['carImage'] = $request->file('carImage')->store('car_images', 'public');
        }

        $car->update($data);

        return redirect()->route('driver.vehicle.index')->with('success', 'Vehicle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
  
        return redirect()->route('driver.vehicle.index')
                        ->with('success','Vehicle deleted successfully');
    }
}
