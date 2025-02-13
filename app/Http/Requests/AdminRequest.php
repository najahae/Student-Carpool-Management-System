<?php

namespace App\Http\Requests;

use App\Models\Admin;
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
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique((new Admin)->getTable())->ignore(auth()->id())],
            'password' => ['nullable', 'min:8', 'confirmed'],
        ];
    }

}
