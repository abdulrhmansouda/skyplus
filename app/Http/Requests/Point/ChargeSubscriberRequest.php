<?php

namespace App\Http\Requests\Point;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChargeSubscriberRequest extends FormRequest
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
            'month' => ['required', 'numeric', 'between:1,12'],
            'pay' => ['required', 'string' , Rule::in(['true' , 'false'])],
        ];
    }
}
