<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        // dd($this->all());
        return [
            'name' => ['required', 'string', 'min:2',],
            'username' => ['required', 'string', "unique:users,username,$this->id"],
            'password' => ['nullable',],
            't_c' => ['required', 'string ', 'min:11', 'max:11'],
            'phone' => ['required', 'string ', 'max:100'],
            'status' => ['required' ,'numeric', Rule::in([UserStatusEnum::ACTIVE->value,UserStatusEnum::CLOSED->value]) ],
        ];
    }
}
