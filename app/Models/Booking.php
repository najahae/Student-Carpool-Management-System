<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Passenger;
use App\Models\Carpool;

class Booking extends Model
{
    use HasFactory;
    public $table = 'bookings';
    
    protected $fillable = [
        'passenger_id',
        'carpool_id',
        'number_of_passengers',
        'price',
        'status',
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class, 'passenger_id');
    }

    public function carpool()
    {
        return $this->belongsTo(Carpool::class, 'carpool_id');
    }
}