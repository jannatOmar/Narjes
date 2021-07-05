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
            'input_name.*'=>'required|string',
            'optioInput.*'=>'required',
            // 'optionoption1.*'=>'required',
            // 'optionoption2.*'=>'required',
            // 'optionoption3.*'=>'required',
            // 'optionoption4.*'=>'required',
            // 'optionoption5.*'=>'required',
            // 'optionoption6.*'=>'required',
            // 'optionoption7.*'=>'required',
            // 'optionoption8.*'=>'required',
            // 'optionoption9.*'=>'required',
            // 'optionoption10.*'=>'required',
            // 'optionoption11.*'=>'required',
            // 'optionoption12.*'=>'required',
            // 'optionoption13.*'=>'required',
            // 'optionoption14.*'=>'required',
            // 'optionoption15.*'=>'required',
            // 'optionoption16.*'=>'required',
            // 'optionoption17.*'=>'required',
            // 'optionoption18.*'=>'required',
            // 'optionoption19.*'=>'required',
            // 'optionoption20.*'=>'required',

        ];
    }
    public function messages()
    {
        return[
        'integer'=>'يجب ادخال رقم صحيح',
        'string'=>'يجب ادخال نص',
        'required'=>'هذا الحقل مطلوب',
        'min'=>'يجب أن لا تفل الفيمة عن 0'

   ];
    }
}
