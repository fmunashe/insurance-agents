<?php

namespace App\Http\Requests;

use App\Enum\Role;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->role == Role::ROLES[0];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'product_category_id' => ['required', 'exists:product_categories,id'],
            'name' => ['required', 'unique:products,name,' . $this->product->id],
            'description' => ['required'],

        ];
    }
}
