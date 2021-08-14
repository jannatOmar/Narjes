<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class confirmPaymentRequest extends FormRequest
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
            'total'=>'required|numeric|min:0',
            'p_name'=>'required|string',
            'company'=>'required',
            'after_discount'=>'required|max:10',
            'comments'=>'max:300'
        ];
    }
    public function  messages(){
       return[
            'required'=>'هذا الحقل مطلوب ',
            'string'=>'يجب ادخال نص',
            'numeric'=>'هذا الحقل أرقام فقط',
            'min'=>'يجب أن لا تفل الفيمة عن 0',
            'after_discount.max'=>'يجب أن لا يزيد الطول عن 10',
            'comments.max'=>'يجب أن لا تزيد عن300 حرف'
        ];
    }
}
