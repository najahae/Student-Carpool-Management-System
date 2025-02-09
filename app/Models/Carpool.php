<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
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

    public function user(){
        return $this->belongsTo('App\Models\User', 'driverID');
    }

    public function car(){
        return $this->belongsTo('App\Models\Car', 'carID');
    }
}
