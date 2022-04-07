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
            'name' => ['string'],
            'username' => ['string','unique:users'],
            'password' => ['nullable','min:8'],
            'image' => ['nullable','image'],
            'account' => ['numeric',],
            'description' => ['string','max:1000',],
        ];
    }
}
