<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Expense2StoreRequest extends FormRequest
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

            'product' =>  ['required', 'max:255'],
            'total' => ['required', 'max:255']
        ];
    }
}
