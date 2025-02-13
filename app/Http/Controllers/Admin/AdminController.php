<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Requests\AdminRequest;
use Illuminate\Requests\PasswordRequest;

class AdminController extends Controller
{
    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(AdminRequest $request) // Fix DriverRequest -> ProfileRequest
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
