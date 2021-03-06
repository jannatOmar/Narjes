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
            'f_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'm_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'l_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'birthday'=>'required',
            'gender'=>'required',
            'email'=>'email|nullable|max:100',
            'address'=>'required|max:100',
            'phone'=>'digits_between:10,14|nullable',
            

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
             'min'=>'يجب أن لا تفل الفيمة عن 0',
            'f_name.max'=>'يجب أن لا يزيد عن 30 حرف',
            'm_name.max'=>'يجب أن لا يزيد عن 30 حرف',
            'l_name.max'=>'يجب أن لا يزيد عن 30 حرف',
            'email.max'=>'يجب أن لا يزيد عن 100 حرف',
            'address.max'=>'يجب أن لا يزيد عن 100 حرف',
            'phone.digits_between'=>'رقم الجوال مكون من 10 الى 14 رقم',



        ];
    }
}
