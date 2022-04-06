<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

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
            'name' => ['required','string'],
            'username' => ['required','string','unique:users'],
            'password' => ['required','min:8'],
            'image' => ['image'],
            'account' => ['required','numeric',],
            'description' => ['string','max:1000',],
        ];
    }
}
