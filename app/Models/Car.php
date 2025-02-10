<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Driver;

class Car extends Model
{
    use HasFactory;

    public $table = 'car';

    protected $fillable = [
        'driverID',
        'carType',
        'carModel',
        'carColor',
        'carPlate',
        'carCapacity',
        'carImage',
        'roadtaxExp',
    ];

    public function driver(){
        return $this->belongsTo('App\Models\Driver', 'driverID');
    }

}
