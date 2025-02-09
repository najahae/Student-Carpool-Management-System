<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
        'fullname' => ['required', 'string', 'max:255'],
        'gender' => ['required', 'string', 'max:255'],
        'studentID' => ['required', 'string', 'max:255'],
        'phoneNum' => ['required', 'string', 'max:15'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'studentCard' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate as an image
        'licenseCard' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'], // Validate as an image
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Handle file upload
        $studentCardPath = null;
        if (isset($data['studentCard'])) {
            $studentCardPath = $data['studentCard']->store('student_cards', 'public'); // Store in storage/app/public/student_cards
        }

        $licenseCardPath = null;
        if (isset($data['licenseCard'])) {
            $licenseCardPath = $data['licenseCard']->store('license_cards', 'public'); // Store in storage/app/public/student_cards
        }

        return User::create([
            'fullname' => $data['fullname'],
            'gender' => $data['gender'],
            'studentID' => $data['studentID'],
            'phoneNum' => $data['phoneNum'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'studentCard' => $studentCardPath, // Save the file path
            'licenseCard' => $licenseCardPath,
        ]);
    }
}
