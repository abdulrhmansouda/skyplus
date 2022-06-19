<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserRoleEnum;
use App\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;


class StoreAdminRequest extends FormRequest
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
            'username' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            't_c' => ['required', 'string ', 'min:11', 'max:11'],
            'phone' => ['required', 'string ', 'max:100'],
            // 'status' => ['required' ,'numeric', Rule::in([UserStatusEnum::ACTIVE->value,UserStatusEnum::CLOSED->value]) ],

        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
            'user' => [
                'username' => $this->username,
                'role'     => UserRoleEnum::ADMIN->value,
                'password' => Hash::make($this->password)
            ],
            'admin' => [
                'name' => $this->name,
                // 'user_id'
                // $admin->name = $request->name;
                // $admin->user_id = $user->id;
                't_c'           => $this->t_c,
                // $admin->t_c = $request->t_c;
                'phone'         => $this->phone,
                // $admin->phone = $request->phone;
                'status'        => UserStatusEnum::ACTIVE->value,
                // $admin->status = $request->status;
            ],
        ];
    }
}
