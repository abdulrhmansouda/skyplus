<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePointRequest extends FormRequest
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
            'password' => ['required','min:8'],
            'account' => ['required','numeric','between:0,0'],
            'charge_commission' => ['required' ,'numeric' ,'min:0','max:100' ,],
            'new_commission' => ['required' ,'numeric' ,'min:0' ,],
            'switch_commission' => ['required' ,'numeric' ,'min:0' ,],
            't_c' => ['required' , 'string ','min:11' ,'max:11' ],
            'phone' => ['required' , 'string ','max:100'],
            'image' => ['nullable','image'],
            'address' => ['nullable','string','max:1000',],
            'borrowing_is_allowed' => ['nullable' ,Rule::in(['true',]) ],
            // 'status' => ['required' , Rule::in(['active', 'deactive' , 'closed']) ],
        ];
    }
}
