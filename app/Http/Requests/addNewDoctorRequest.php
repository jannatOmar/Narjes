<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addNewDoctorRequest extends FormRequest
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

            'first_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'middle_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'last_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'email'=>'required|max:100|email|unique:doctor,email'.$this->doctor_id,
            'address'=>'required|max:100',
            'phone'=>'required|digits_between:10,14|unique:doctor,phone'.$this->doctor_id,

        ];

    }
    public function messages()
    {
        return[
            'email'=>'يجب ادخال الايميل بالصورة الصحيحة',
            'required'=>'هذا الحقل مطلوب ',
            'regex'=>'يجب ادخال نص خالي من الأرقام والاشارات',
            'first_name.max'=>'يجب أن لا يزيد عن 30 حرف',
            'middle_name.max'=>'يجب أن لا يزيد عن 30 حرف',
            'last_name.max'=>'يجب أن لا يزيد عن 30 حرف',
            'email.max'=>'يجب أن لا يزيد عن 100 حرف',
            'address.max'=>'يجب أن لا يزيد عن 100 حرف',
           
            'string'=>'يجب ادخال نص',
            'email.unique'=>'البريد الاكتروني مستخدم من قبل',
            'phone.unique'=>' رقم الجوال مستخدم من قبل',
            'phone.digits_between'=>'رقم الجوال مكون من 10 الى 14 رقم',
        ];
    }
}
