<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->role == 'admin')
        {
            return true;
        }
        else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'image' => 'required|image',
            'name' => 'required|string|min:5|max:80',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'category_id' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'image must be filled',
            'image.image' => 'the format must be image type',
            'name.required' => 'item name must be filled',
            'name.string' => 'item name must be a string',
            'name.min' => 'item name must contain at least 5 characters',
            'name.max' => 'item name must contain no more than 80 characters',
            'price.required' => 'item price must be filled',
            'price.integer' => 'item price must be a number',
            'quantity.required' => 'item quantity must be filled',
            'quantity.integer' => 'item quantity must be a number',
            'category_id.required' => 'category must be filled',
        ];
    }
}
