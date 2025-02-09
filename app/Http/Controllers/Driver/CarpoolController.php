<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Car;

class CarpoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carpool = Carpool::with('user', 'car')
        ->get();
        //dd( $carpool);
        return view('carpool.index',compact('carpool'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = User::select('id', 'fullname', 'gender')->get();
        $car = Car::select('id', 'carModel', 'carColor', 'carPlate', 'carCapacity')->get();

        return view('carpool.create', compact('user', 'car'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Carpool::create([
            //'user_id' => auth()->user()->id,
            'driverID' => $request->user_id,
            'carID' => $request->car_id,
            'pickup_loc' => $request->pickup_loc,
            'dropoff_loc' => $request->dropoff_loc,
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'available_seats' => $request->available_seats,
            'total_fare' => $request->total_fare,
            'fare_per_head' => $request->fare_per_head,
            'status' => $request->status,
           ]);
      
        return redirect()->route('carpool.index')
            ->with('success','Carpool created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carpool $carpool)
    {
        return view('carpool.show',compact('carpool'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carpool $carpool)
    {
        $user = User::select('id', 'fullname', 'gender')->get();

        $car = Car::select('id', 'carModel', 'carColor', 'carPlate', 'carCapacity')->get();

        return view('carpool.edit',compact('user', 'car', 'carpool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carpool $carpool)
    {
        $carpool->update($request->all());

       return redirect()->route('carpool.index')
                        ->with('success','Carpool updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carpool $carpool)
    {
        $carpool->delete();
  
        return redirect()->route('carpool.index')
                        ->with('success','Carpool deleted successfully');
    }
}
