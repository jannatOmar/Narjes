<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFormRequest extends FormRequest
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
            
            'price'=> 'required|numeric|integer|min:0',
            'group'=> 'required',
            'max_normal.*'=>'required',
            'min_normal.*'=>'required',
            'unit.*'=>'required|string',
            'input_name.*'=>'required|string|regex:/^[a-zA-Z]+$/u',
            'optioInput.*'=>'required',
           

        ];
    }
    public function messages()
    {
        return[
            'regex'=>'يجب ادخال الفترة بالصورة الصحيحة؟-؟  ',
        'integer'=>'يجب ادخال رقم صحيح',
        'string'=>'يجب ادخال نص',
        'required'=>'هذا الحقل مطلوب',
        'regex'=>'يجب ادخال نص خالي من الأرقام والاشارات',
        'min'=>'يجب أن لا تفل الفيمة عن 0'

   ];
    }
}
