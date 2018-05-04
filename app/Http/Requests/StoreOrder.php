<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrder extends FormRequest
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
            'client_email'=>'required|email',
			'partner_id'=>'required|integer',
	        'status'=>'required|integer|in:0,10,20'

        ];
    }
	public function messages()
	{
		return [
			'client_email.required' => 'Необходимо указать e-mail адрес',
			'client_email.email'=>'Неверный email',
			'partner_id.required'=>'Необходимо указать партнера',
			'partner_id.integer'=>'Неверный ИД партнера',
			'status.required'=>'Необходимо указать статус заказа',
			'status.integer'=>'Неверный статус заказа',
		];
	}
}
