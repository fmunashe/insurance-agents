<?php

namespace App\Http\Requests;

use App\Enum\Role;
use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'surname' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
            'id_number' => 'required',
            'address' => 'required',
            'email' => 'required|email'
        ];
    }
}
