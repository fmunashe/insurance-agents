<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsuredRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'exists:products,id'],
            'sum_insured' => ['required', 'numeric'],
            'premium' => ['required', 'numeric'],
            'rate' => ['required', 'numeric'],
            'policy_number' => ['required'],
            'supplier_id' => ['required'],
            'currency_id' => ['required'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date','after:start_date'],
            'status' => ['required'],
            'number_of_terms' => ['required'],
        ];
    }
}
