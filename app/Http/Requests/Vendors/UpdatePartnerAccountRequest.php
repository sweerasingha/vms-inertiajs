<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePartnerAccountRequest extends FormRequest
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
            'type' => ['required','string','max:255'],
            'name' => ['required','string','max:255'],
            'address_line_1' => ['nullable','string','max:255'],
            'address_line_2' => ['nullable','string','max:255'],
            'contact_1' => ['required','string','digits_between:9,15'],
            'contact_2' => ['nullable','string','digits_between:9,15'],
            'fax' => ['nullable','digits_between:9,15','numeric'],
            'web_site' => ['nullable','url'],
        ];
    }

    public function messages()
    {
        return [
            'contact_1.numeric' => "Contact number must be numeric.",
            'contact_2.numeric' => "Contact number must be numeric.",
        ];
    }
}
