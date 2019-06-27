<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'price' => 'integer|min:1'
        ];
    }

    public function messages()
    {
        return [
            'price.integer' => 'Цена может быть только число',
            'price.min' => 'Цена может быть меньше или равно 0'
        ];
    }
}
