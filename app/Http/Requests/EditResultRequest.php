<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditResultRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [

            'result.*'=>'required',
            'Data.*'=>'required',

        ];
    }
    public function messages()
    {
        return[
        'required'=>'هذا الحقل مطلوب',


         ];
    }
}
