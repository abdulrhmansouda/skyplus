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
            'months' => ['required', 'numeric', 'between:1,12'],
            'type' => ['required', Rule::in(['true', 'false', 'upgrate'])],
            'package_id' => [Rule::requiredIf($this->type === 'upgrate'),'exists:packages,id'],
        ];
    }
}
