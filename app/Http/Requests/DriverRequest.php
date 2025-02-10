<?php

namespace App\Http\Requests;

use App\Models\Driver;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class DriverRequest extends FormRequest
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
            'fullname' => ['required', 'min:3'],
            'gender' => ['required', 'in:male,female'],
            'studentID' => ['required', 'string', 'max:20', Rule::unique((new Driver)->getTable())->ignore(auth()->id())],
            'phoneNum' => ['required', 'digits_between:10,15', Rule::unique((new Driver)->getTable())->ignore(auth()->id())],
            'email' => ['required', 'email', Rule::unique((new Driver)->getTable())->ignore(auth()->id())],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'studentCard' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'licenseCard' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ];
    }

}
