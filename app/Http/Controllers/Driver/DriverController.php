<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\DriverRequest;
use App\Http\Requests\PasswordRequest;

class DriverController extends Controller
{
    public function edit()
    {
        return view('driver.profile.edit');
    }

    public function update(DriverRequest $request) // Fix DriverRequest -> ProfileRequest
    {
        auth()->user()->update($request->all()); // Fix auth()->driver() -> auth()->user()

        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]); // Fix auth()->driver() -> auth()->user()

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}

