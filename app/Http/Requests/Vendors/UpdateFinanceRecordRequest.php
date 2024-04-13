<?php

namespace App\Http\Requests\Vendors;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFinanceRecordRequest extends FormRequest
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
            'payee_account_code' => ['required'],
            'gl_code' => ['required'],
            'tax_no' => ['required','numeric','min:0'],
            'vat_no' => ['required','min:0','numeric'],
            'incoterms' => ['nullable','max:255'],
            'credit_days' => ['nullable','numeric'],
            'payment_terms' => ['nullable'],
        ];
    }
}
