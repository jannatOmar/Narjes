<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddPatientRequest extends FormRequest
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
            'birthday'=>'required',
            'gender'=>'required',
            'email'=>'email|nullable',
            'address'=>'required',
            'phone'=>'min:10|max:14|nullable',

        ];
    }
    public function messages()
    {
        return [
            
           'email'=>'يجب اخال الايميل بالصورة الصحيحة',
           'regex'=>'يجب ادخال نص خالي من الأرقام والاشارات',
            'required'=>'هذا الحقل مطلوب ',
            'gender.required'=>'هذا الحقل مطلوب ',
            'birthday.required'=>'هذا الحقل مطلوب ',
            'age.required'=>'هذا الحقل مطلوب ',
            'address.required'=>'هذا الحقل مطلوب ',
             'phone.min'=>' رقم الجوال مكون من 10 منازل على الأقل',
             'phone.max'=>'رقم الجوال مكون من 14 منازل على الأكثر',
             'string'=>'يجب ادخال نص',
             'numeric'=>'يجب ادخال رقم',
             'min'=>'يجب أن لا تفل الفيمة عن 0'

        ];
    }
}
