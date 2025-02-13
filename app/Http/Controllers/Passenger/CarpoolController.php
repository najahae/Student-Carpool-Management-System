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
    public function index(Request $request)
    {
        $carpool = Carpool::with('driver', 'car')
        ->get();

        $query = Carpool::with('driver', 'car');

        // Check if the gender filter is applied
        if ($request->filled('gender')) {
            $query->whereHas('driver', function ($q) use ($request) {
                $q->where('gender', $request->gender);
        });
        }

        // Fetch timetables based on the query (filtered or not)
        $carpool = $query->get();
        //dd( $carpool);
        // Calculate fare per head dynamically

        return view('passenger.carpool.index',compact('carpool'));
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
