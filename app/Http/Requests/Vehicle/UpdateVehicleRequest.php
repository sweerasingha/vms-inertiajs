<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVehicleRequest extends FormRequest
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
        return[
            'code' =>  ['required','unique:vehicles,code,' . $this->id],
            'country_id' =>  ['required'],
            'vehicle_category_id' =>  ['required'],
            'name' =>  ['required','max:255','string'],
            'address_line_1' =>  ['nullable','max:255'],
            'address_line_2' =>  ['nullable','max:255'],
            'address_line_3' =>  ['nullable','max:255'],
            'contact_1' =>  ['nullable','numeric','digits_between:9,10'],
            'contact_2' =>  ['nullable','numeric','digits_between:9,10'],
            'fax' =>  ['nullable','numeric','digits_between:9,10'],
            'brc_no' =>  ['nullable','max:255'],
            'nic_no' =>  ['nullable','string'],
            'web_site' =>  ['nullable','url'],
        ];
    }

    /**
     * messages
     *
     * @return void
     */
    public function messages(){
        return[
            'country_id.required' => 'Country is required.',
            'vehicle_category_id.required' => 'Vehicle Category is required.',
            'contact_1.numeric' => "Contact number must be numeric.",
            'contact_2.numeric' => "Contact number must be numeric.",
            'contact_1.digits_between' => "Contact number must content 9 or 10 digits.",
            'contact_2.digits_between' => "Contact number must content 9 or 10 digits.",
        ];
    }
}
