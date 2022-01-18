<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceStoreRequest extends FormRequest
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
//            'arka' => ['nullable', 'max:255'],
//            'pos' => ['required', 'max:255'],
//            'order' => ['required', 'max:255'],
//            'expense' => ['required', 'max:255'],
//            'mbtja' => ['required', 'max:255'],
//            'serialNumber' => ['required', 'max:255'],
//            'data' => ['required', 'max:255'],
        ];
    }
}
