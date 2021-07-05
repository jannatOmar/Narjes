<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class updateDoctorRequest extends FormRequest
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

           
            'first_name'=>'required|string|regex:/^[a-zA-Z]+$/u',
            'middle_name'=>'required|string|regex:/^[a-zA-Z]+$/u',
            'last_name'=>'required|string|regex:/^[a-zA-Z]+$/u',
            'email'=>'required|email',
            'address'=>'required',
            'phone'=>'required|digits_between:10,14',

        ];

    }
    public function messages()
    {
        return[
            'email'=>'يجب ادخال الايميل بالصورة الصحيحة',
            'required'=>'هذا الحقل مطلوب ',
            'string'=>'يجب ادخال نص',
            'regex'=>'يجب ادخال نص خالي من الأرقام والاشارات',

            'email.unique'=>'البريد الاكتروني مستخدم من قبل',
            'phone.unique'=>' رقم الجوال مستخدم من قبل',
            'phone.digits_between'=>'رقم الجوال مكون من 10 الى 14 رقم',


        ];
    }
}
