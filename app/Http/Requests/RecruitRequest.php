<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecruitRequest extends FormRequest
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
            'name' => ['required', 'max:50'],
            'name_kana' => ['required', 'max:50'],
            'birthday' => ['required', 'max:10', 'regex:<^\d{4}/\d{1,2}/\d{1,2}$>'],
            'gender' => 'required',
            'email' => ['required', 'max:100', 'regex:<^\w+@\w+\.\w+$>'],
            'phone' => ['required', 'max:14', 'regex:<^\d{3,4}-\d{4}-\d{4}$>'],
            'is_experienced' => 'required',
        ];
    }

}
