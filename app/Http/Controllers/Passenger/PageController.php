<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{

    /**
     * Display maps page
     *
     * @return \Illuminate\View\View
     */
    public function maps()
    {
        return view('passenger.map.maps');
    }

    /**
     * Display carpool page
     *
     * @return \Illuminate\View\View
     */
    public function carpool()
    {
        return view('passenger.carpool.index');
    }

}
