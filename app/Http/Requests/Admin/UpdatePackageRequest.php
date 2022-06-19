<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePackageRequest extends FormRequest
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
            'name' => ['required','string' ,"unique:packages,name,$this->id",'min:2','max:1000'],
            'price' => ['required','numeric'],
            'status' => ['required' , Rule::in(UserStatusEnum::ACTIVE->value,UserStatusEnum::CLOSED->value)],
        ];
    }
}
