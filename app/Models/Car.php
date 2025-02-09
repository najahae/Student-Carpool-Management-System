<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    public function user(){
        return $this->belongsTo('App\Models\User', 'driverID');
    }
}
