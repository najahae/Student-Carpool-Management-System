<?php

namespace App\Http\Controllers\Driver;

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
        return view('driver.map.maps');
    }

    /**
     * Display carpool page
     *
     * @return \Illuminate\View\View
     */
    public function vehicle()
    {
        return view('driver.vehicle.index');
    }

    /**
     * Display carpool page
     *
     * @return \Illuminate\View\View
     */
    public function carpool()
    {
        return view('driver.carpool.index');
    }

}
