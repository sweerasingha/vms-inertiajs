<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaxRequest extends FormRequest
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
            'tax_name'=> ['required','string','max:255'],
            'tax_type'=> ['required','string','max:255'],
            'value'=> ['required', 'numeric','min:0'],
        ];
    }
}
