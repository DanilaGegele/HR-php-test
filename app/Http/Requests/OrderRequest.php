<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Order;

class OrderRequest extends FormRequest
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
        $statusValue = [
            Order::STATUS_NEW,
            Order::STATUS_CONFIRMED,
            Order::STATUS_COMPLETED
        ];
        return [
            'client_email' => 'required|email',
            'status' => 'in:' . implode(',', $statusValue),
            'partner_id' => 'exists:partners,id'
        ];
    }


    public function messages()
    {
        return [
            'client_email.required' => 'Емайл клиента объязателен для ввода',
            'client_email.email' => 'Емайл клиента не имайл',
            'status.in'  => 'Не верно указан статус',
            'partner_id.exists'  => 'Не верно указан партнёр',
        ];
    }

}
