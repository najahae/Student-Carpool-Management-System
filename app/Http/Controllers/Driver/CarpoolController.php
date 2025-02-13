<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Car;
use App\Models\Carpool;
use Illuminate\Support\Facades\Auth;

class CarpoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carpool = Carpool::with('driver', 'car')
        ->get();
        //dd( $carpool);
        // Calculate fare per head dynamically

        // foreach ($carpool as $c) {
        //     if ($c->car && $c->car->carCapacity > 0) {
        //         $c->fare_per_head = number_format($c->total_fare / $c->car->carCapacity, 2);
        //     } else {
        //         $c->fare_per_head = 0; // Default if capacity is invalid
        //     }
        // }

        $carpool = Carpool::where('driverID', Auth::id())->get();
        return view('driver.carpool.index',compact('carpool'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $driver = Driver::pluck('studentID', 'id'); // id => studentID
        $car = Car::pluck('carPlate', 'id'); // id => carPlate

        return view('driver.carpool.create', compact('driver', 'car'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carpool = Carpool::create($request->all());
        return redirect()->route('driver.carpool.index')
            ->with('success', 'Carpool created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carpool $carpool)
    {
        return view('driver.carpool.show',compact('carpool'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carpool $carpool)
    {
        $driver = Driver::pluck('studentID', 'id');

        $car = Car::pluck('carPlate', 'id');

        return view('driver.carpool.edit',compact('driver', 'car', 'carpool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carpool $carpool)
    {
        $carpool->update($request->all());

       return redirect()->route('driver.carpool.index')
                        ->with('success','Carpool updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carpool $carpool)
    {
        $carpool->delete();
  
        return redirect()->route('driver.carpool.index')
                        ->with('success','Carpool deleted successfully');
    }
}
