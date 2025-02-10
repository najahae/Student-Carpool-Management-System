<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;
use App\Models\Car;

class Carpool extends Model
{
    use HasFactory;

    public $table = 'carpool';

    protected $fillable = [
        'driverID',
        'carID',
        'pickup_loc',
        'dropoff_loc',
        'pickup_date',
        'pickup_time',
        'available_seats',
        'total_fare',
        'fare_per_head',
        'status',
    ];

    public function driver(){
        return $this->belongsTo('App\Models\Driver', 'driverID');
    }

    public function car(){
        return $this->belongsTo('App\Models\Car', 'carID');
    }

    public function getFarePerHeadAttribute()
    {
        if ($this->car && $this->car->carCapacity > 0) {
            return number_format($this->total_fare / $this->car->carCapacity, 2);
        }
        return 0; // Default value if car capacity is 0 or null
    }

}
