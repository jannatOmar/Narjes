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
            'f_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'm_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'l_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:30',
            'gender'=>'required',
            'birthday'=>'required|date',
            'email'=>'email|nullable|max:100',
            'address'=>'required|max:100',
            'phone'=>'digits_between:10,14',
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
             'date'=>' mm/dd/yyyyيجب ادخال التاريخ بصورة صحيحة',
             'f_name.max'=>'يجب أن لا يزيد عن 30 حرف',
             'm_name.max'=>'يجب أن لا يزيد عن 30 حرف',
             'l_name.max'=>'يجب أن لا يزيد عن 30 حرف',
             'email.max'=>'يجب أن لا يزيد عن 100 حرف',
             'address.max'=>'يجب أن لا يزيد عن 100 حرف',
             'phone.digits_between'=>'رقم الجوال مكون من 10 الى 14 رقم',

              
        ];
    }
    
}
