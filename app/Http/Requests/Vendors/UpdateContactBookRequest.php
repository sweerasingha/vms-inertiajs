<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContactBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required','max:255','string'],
            'designation' => ['required','max:255'],
            'email' => ['required','email','max:255'],
            'mobile_no' => ['required','numeric','digits_between:9,15'],
            'land_no' => ['required','numeric','digits_between:9,15'],
        ];
    }
}
