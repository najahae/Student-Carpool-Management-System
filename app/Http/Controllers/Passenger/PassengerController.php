<?php

namespace App\Http\Controllers\Passenger;

use App\Http\Controllers\Controller;
use App\Http\Requests\PassengerRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;

class PassengerController extends Controller
{
        public function edit()
    {
        return view('passenger.profile.edit');
    }

    public function update(PassengerRequest $request) 
    {
        auth()->user()->update($request->all()); 

        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }

    public function store(Request $request)
    {
        $passenger = new Passenger();
        $passenger->name = $request->name;
        $passenger->email = $request->email;
        $passenger->student_id = $request->student_id;
        $passenger->phone = $request->phone;
        $passenger->password = Hash::make($request->password);
        $passenger->chat_id = null; // Initially null until they link Telegram
        $passenger->save();

    }
}
