<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubscriberRrequest extends FormRequest
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
            'name' => ['required' ,'string' ,'min:2' ,'max:100' ],
            't_c' => ['required' ,'string' , 'max:100' ],
            'phone' => ['required' ,'string' , 'max:100' ],
            'sub_id' => ['required' ,'numeric' ,'unique:subscribers' ,],
            'subscriber_number' => ['required' ,'numeric' ,'unique:subscribers' ,],
            'mother' => ['required' ,'string' ,'min:2' ,'max:100' ],
            'subscribtion_date' => ['required' ,'date' ,],
            'package_id' => ['required' ,'exists:packages,id' ,],
            'status' => ['required' , Rule::in(['active', 'deactive' , 'closed']) ],
            'address' => ['required' ,'string' ,'max:1000' ],
            'installation_address' => ['required' ,'string' ,'max:1000' ],

        ];
    }
}
