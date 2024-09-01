<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'address_target' => 'required|min:10|max:100|string',
            'post_code_target' => 'required|digits:5|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'address_target.required' => 'target address must be filled',
            'address_target.min' => 'target address must contain at least 10 characters',
            'address_target.max' => 'target address must contain no more than 100 characters',
            'address_target.string' => 'target address must be a string',
            'post_code_target.required' => 'target post code must be filled',
            'post_code_target.digits' => 'target post code must contain 5 digits',
            'post_code_target.integer' => 'target post code must be a number',
        ];
    }
}
