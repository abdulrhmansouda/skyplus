<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class UpdateAdminRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2',],
            'username' => ['required', 'string', "unique:users,username,$this->id"],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            't_c' => ['required', 'string ', 'min:11', 'max:11'],
            'phone' => ['required', 'string ', 'max:100'],
            'status' => ['required' , Rule::in(['active', 'closed']) ],
        ];
    }
}
