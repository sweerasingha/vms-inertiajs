<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class CreateVendorRequest extends FormRequest
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
            'country_id' => ['required','max:255'],
            'currency_id' => ['required'],
            'code' => ['required','unique:vendors,code','string'],
            'name' => ['required','string','max:255'],
        ];
    }

    public function messages(){
        return[
            'country_id.required' => 'Country is required.',
            'currency_id.required' => 'Currency is required.',
        ];        
    }
}
