<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddNewUserRequest extends FormRequest
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
            'f_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'm_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'l_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'start_date'=>'required',
            'role_name'=>'required',
            'age'=>'required|numeric|min:0',
            'email'=>'required|email|unique:user,email,'.$this->id,
            'address'=>'required',
            'password'=>'required',
            'username'=>'required|unique:user,username,'.$this->id,
            'phone'=>'required|digits_between:10,14|unique:user,phone,'.$this->id,

        ];

    }
    public function messages()
    {
        return [

           'email'=>'يجب ادخال الايميل بالصورة الصحيحة',
            'required'=>'هذا الحقل مطلوب ',
            'regex'=>'يجب ادخال نص خالي من الأرقام والاشارات',
             'string'=>'يجب ادخال نص',
             'numeric'=>'يجب ادخال رقم',
             'email.unique'=>'البريد الاكتروني مستخدم من قبل',
             'phone.unique'=>' رقم الجوال مستخدم من قبل',
             'username.unique'=>'اسم المستخدم مستخدم من قبل',
             'phone.digits_between'=>'رقم الجوال مكون من 10 الى 14 رقم',
            'max'=>'يجب أن لا يزيد عن 30 حرف',
             'min'=>'يجب أن لا تفل الفيمة عن 0'

        ];
    }
}
