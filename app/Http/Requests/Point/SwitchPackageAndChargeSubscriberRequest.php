<?php

namespace App\Http\Requests\Point;

use Illuminate\Foundation\Http\FormRequest;

class SwitchPackageAndChargeSubscriberRequest extends FormRequest
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
            'months' => ['required', 'numeric', 'between:1,12'],
            'package_id' => ['required', 'exists:packages,id'],
        ];
    }
}
