<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionStoreRequest extends FormRequest
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
            'paid_amount' => ['required', 'string', 'max:255'],
            'given_amount' => ['required', 'string', 'max:255'],
            'balance' => ['required', 'string', 'max:255'],
            'payment_method' => ['required', 'string', 'max:255'],
            'user_id' => ['required', 'string'],
            'close_order' => ['boolean'],

        ];
    }
}
