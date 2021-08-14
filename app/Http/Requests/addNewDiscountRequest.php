<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class addNewDiscountRequest extends FormRequest
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
            'company_name'=>'required|string|regex:/^[a-zA-Z]+$/u|max:100',
            'discount_percentage'=>'required|numeric|min:0|max:100',
            'discount_type'=>'required|string|regex:/^[a-zA-Z]+$/u|max:100',
            'company_finantial_recivable'=>'required|numeric|min:0|max:100',
            'laboratory_finatial_recivable'=>'required|numeric|min:0|max:100',
        ];
    }
    public function messages()
    {
        return[
        'string'=>'يجب ادخال نص',
        'regex'=>'يجب ادخال نص خالي من الأرقام والاشارات',
        'numeric'=>'يجب ادخال رقم',
        'required'=>'هذا الحقل مطلوب',
        'min'=>'يجب أن لا تقل القيمة عن 0',
        'max'=>' يجب أن لا تزيد القيمة عن 100',
        'company_name.max'=>' يجب أن لا يزيد الطول عن 100',
        'discount_type.max'=>' يجب أن لا يزيد الطول عن 100',
   ];
    }
}
