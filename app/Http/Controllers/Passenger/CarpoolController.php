<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Car;
use App\Models\Carpool;

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
        foreach ($carpool as $c) {
            if ($c->car && $c->car->carCapacity > 0) {
                $c->fare_per_head = number_format($c->total_fare / $c->car->carCapacity, 2);
            } else {
                $c->fare_per_head = 0; // Default if capacity is invalid
            }
        }

        return view('driver.carpool.index',compact('carpool'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $driver = Driver::pluck('studentID', 'id'); // id => studentID
        $car = Car::pluck('carPlate', 'id'); // id => carPlate

        return view('passenger.carpool.create', compact('driver', 'car'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $carpool = Carpool::create($request->all());
        return redirect()->route('passenger.carpool.index')
            ->with('success', 'Carpool created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Carpool $carpool)
    {
        return view('passenger.carpool.show',compact('carpool'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Carpool $carpool)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Carpool $carpool)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Carpool $carpool)
    {
        
    }
}
