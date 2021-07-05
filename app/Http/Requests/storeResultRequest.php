<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeResultRequest extends FormRequest
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
            //
            'Data.*'=>'required',
            'Data_Op.*'=>'required',
            'input_Op.*'=>'required|string',
            'input_name.*'=>'required|string'

        ];
    }
    public function messages()
    {
        return[
        'required'=>'هذا الحقل مطلوب',
        'string'=>'يجب ادخال نص'

   ];
    }
}
