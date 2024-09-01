<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'address' => 'required|min:10|max:100|string',
            'post_code' => 'required|digits:5|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'address.required' => 'address must be filled',
            'address.min' => 'address must contain at least 10 characters',
            'address.max' => 'address must contain no more than 100 characters',
            'address.string' => 'address must be a string',
            'post_code.required' => 'post code must be filled',
            'post_code.digits' => 'post code must contain 5 digits',
            'post_code.integer' => 'post code must be a number',
        ];
    }
}
