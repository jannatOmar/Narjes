<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewFormRequest extends FormRequest
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
            'analysis_name'=>'required|unique:analysis,analysis_name'.$this->id,
            'price'=> 'required|numeric|integer|min:0',
            'group'=> 'required',
            'max_normal.*'=>'required',
            'min_normal.*'=>'required',
            'input.*'=>'required|string',
            'unit.*'=>'required',
            'optioInput.*'=>'required',



        ];
    }
    public function messages()
    {
        return[
        'integer'=>'يجب ادخال رقم صحيح',
        'analysis_name.required'=> 'هذا الحقل مطلوب',
        'string'=>'يجب ادخال نص',
        'required'=>'هذا الحقل مطلوب',
        'unique'=>'هذا الاسم موجود من قبل',
        'min'=>'يجب أن لا تفل الفيمة عن 0'

   ];
    }
}
