<?php

namespace App\Http\Requests\Vehicle;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBankAccountRequest extends FormRequest
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
            'bank_name' => ['required','string','max:255'],
            'bank_code' => ['required','string','max:255'],
            'branch_name' => ['required','string','max:255'],
            'branch_code' => ['required','string','max:255'],
            'swift_code' => ['required','string','max:255'],
            'account_no' => ['required','numeric' ],
        ];
    }
}
