<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addNewInputsRequest extends FormRequest
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
            'max_normal.*'=>'required|string',
            'min_normal.*'=>'required|string',
            'input.*'=>'required|string',
            'unit.*'=>'required|string',
            'optioInput.*'=>'required',

        ];
    }
    public function messages()
    {
        return[
        'string'=>'يجب ادخال نص',
        'required'=>'هذا الحقل مطلوب',
        'min'=>'يجب أن لا تفل الفيمة عن 0'
   ];
    }
}
