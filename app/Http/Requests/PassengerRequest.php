<?php

namespace App\Http\Requests;

use App\Models\Passenger;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PassengerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        return [
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique((new Passenger)->getTable())->ignore(auth()->id())],
            'student_id' => ['required', 'string', 'max:20', Rule::unique((new Passenger)->getTable())->ignore(auth()->id())],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'phone' => ['required', 'digits_between:10,15', Rule::unique((new Passenger)->getTable())->ignore(auth()->id())],
        ];
    }

}
