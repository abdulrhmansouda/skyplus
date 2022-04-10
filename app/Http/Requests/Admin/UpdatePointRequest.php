<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePointRequest extends FormRequest
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
            'name' => ['required','string','min:2',],
            'username' => ['required','string','unique:users'],
            'password' => ['nullable','min:8'],
            'account' => ['required','numeric',],
            'commission' => ['required' ,'numeric' ,'min:0','max:100' ,],
            't_c' => ['required' , 'string ','max:100'],
            'phone' => ['required' , 'string ','max:100'],
            'image' => ['nullable','image'],
            'address' => ['nullable','string','max:1000',],
            'borrowing_is_allowed' => ['string' ,],
            'status' => ['bool',],
        ];
    }
}
