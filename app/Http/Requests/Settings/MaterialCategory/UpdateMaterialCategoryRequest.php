<?php

namespace App\Http\Requests\Settings\MaterialCategory;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMaterialCategoryRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'code' => ['required', 'string', 'unique:material_categories,code,' . $this->id],
        ];
    }
}
