<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StockReportRequest extends FormRequest
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
            'product'=>['required', 'max:255'],
//            'start'=>['required', 'max:255'],
//            'end'=>['required', 'max:255'],
//            'evidence'=>['required', 'max:255'],
        ];
    }
}
