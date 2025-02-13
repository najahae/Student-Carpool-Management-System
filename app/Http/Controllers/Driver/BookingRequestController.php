<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Carpool;
use Illuminate\Support\Facades\Auth;
use DB;

class BookingRequestController extends Controller
{

    public function index()
    { 
        $bookings = Booking::where('status', 'pending')
            ->whereIn('carpool_id', function ($query) {
                $query->select('id')->from('carpool')->where('driverID', Auth::id());
            })
            ->get();
    
        return view('driver.booking.index', compact('bookings'));
    } 

    // Accept a booking request
    public function accept(Booking $booking)
    {
        // Ensure only the driver who owns the carpool can accept
        if (!$booking->carpool || $booking->carpool->driverID !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $booking->status = 'accepted';
        $booking->save();

        // Reduce the available seats
        $booking->carpool->decrement('available_seats', $booking->number_of_passengers);

        return redirect()->route('driver.booking.index')->with('success', 'Booking accepted successfully.');
    }

    // Reject a booking request
    public function reject(Booking $booking)
    {
        if (!$booking->carpool || $booking->carpool->driverID !== Auth::id()) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }

        $booking->status = 'rejected';
        $booking->save();

        return redirect()->route('driver.booking.index')->with('success', 'Booking rejected successfully.');
    }
}