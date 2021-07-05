<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            'f_name'=>'required|string|regex:/^[a-zA-Z]+$/u',
            'm_name'=>'required|string|regex:/^[a-zA-Z]+$/u',
            'l_name'=>'required|string|regex:/^[a-zA-Z]+$/u',
            'gender'=>'required',
            'birthday'=>'required|date',
            'email'=>'email',
            'address'=>'required',
            'phone'=>'min:10|max:14',
        ];
    }
    public function messages()
    {
        return [
            //
            'required'=>'هذا الحقل مطلوب ',
            'regex'=>'يجب ادخال نص خالي من الأرقام والاشارات',
             'phone.min'=>' رقم الجوال مكون من 10 منازل على الأقل',
             'phone.max'=>'رقم الجوال مكون من 14 منازل على الأكثر',
             'string'=>'يجب ادخال نص',
             'numeric'=>'يجب ادخال رقم',
             'min'=>'يجب أن لا تفل الفيمة عن 0',
             'date'=>' mm/dd/yyyyيجب ادخال التاريخ بصورة صحيحة'

              
        ];
    }
    
}
