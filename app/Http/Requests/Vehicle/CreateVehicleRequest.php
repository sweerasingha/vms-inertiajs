<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class CreateVehicleRequest extends FormRequest
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
            'vehicle_category_id' => ['required'],
            'code' => ['required','unique:vehicles,code','string'],
            'name' => ['required','string','max:255'],
        ];
    }

    public function messages(){
        return[
            'country_id.required' => 'Country is required.',
            'vehicle_category_id.required' => 'Vehicle Category is required.',
        ];
    }
}
