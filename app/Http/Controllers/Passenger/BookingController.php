<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Carpool;
use Illuminate\Support\Facades\Auth;
use DB;

class BookingController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'passenger_id' => 'required',
            'booking_id' => 'required',
            'number_of_passengers' => 'required|integer',
            'price' => 'required|numeric'
        ]);
        
        $carpool = Carpool::findorFail($request->carpool_id);

        if ($carpool->seats_available < $request->number_of_passengers) {
            return redirect()->back()->with('error', 'Not enough seats available.');
        }

        // Create a new booking
        $booking = new Booking();
        $booking->passenger_id = Auth::id(); // Assuming the passenger is logged in
        $booking->carpool_id = $carpool->id;
        $booking->number_of_passengers = $request->number_of_passengers; // Default number of passengers
        $booking->price = $carpool->price_per_head  = number_format($c->total_fare / $c->car->carCapacity, 2) ?? 0; // Set the price from the timetable
        $booking->status = 'pending'; // Default status
        $booking->save();
        
        return redirect()->route('passenger.booking.pending')
                         ->with('success', 'Booking request sent.');

    }

    public function join(Carpool $carpool)
    {
        // Load the related driver and vehicle data
        $carpool->load(['driver', 'car']);

        // Create a new booking
        $booking = new Booking();
        $booking->passenger_id = Auth::id(); // Assuming the passenger is logged in
        $booking->carpool_id = $carpool->id;
        $booking->number_of_passengers = 1; // Default number of passengers
        $booking->price = $carpool->price_per_head ?? 0; // Set the price from the timetable
        $booking->status = 'pending'; // Default status
        $booking->save();

        // Redirect to the pending page with timetable details
        return redirect()->route('passenger.booking.pending', $carpool->id);
    }

    public function pending(Carpool $carpool)
    {
        $carpool->load(['driver', 'car']);
        return view('passenger.carpool.pending', compact('carpool'));
    }

    public function incomingTrips()
    {
        $bookings = Booking::where('passenger_id', Auth::id())->get();
        return view('passenger.carpool.trip', compact('bookings'));
    }    
}
