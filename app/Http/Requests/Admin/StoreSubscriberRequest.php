<?php

namespace App\Http\Requests\Admin;

use App\Enums\UserStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSubscriberRequest extends FormRequest
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
            'name'                      => ['required' ,'string' ,'min:2' ,'max:100' ],
            't_c'                       => ['required' ,'string' , 'min:11' ,'max:11' ],
            'phone'                     => ['required' ,'string' , 'max:100' ],
            'sub_id'                    => ['required' ,'numeric' ,'unique:subscribers' ,],
            'sub_username'              => ['required' , 'string' , 'unique:subscribers' , ],
            'subscriber_number'         => ['required' ,'numeric' ,'unique:subscribers' ,],
            'mother'                    => ['required' ,'string' ,'min:2' ,'max:100' ],
            'package_start'             => ['required' ,'date' ,],
            'package_id'                => ['required' ,'exists:packages,id' ,],
            'status'                    => ['required' , Rule::in([UserStatusEnum::ACTIVE->value, UserStatusEnum::INACTIVE->value , UserStatusEnum::CLOSED->value]) ],
            'address'                   => ['required' ,'string' ,'max:1000' ],
            'installation_address'      => ['required' ,'string' ,'max:1000' ],
            'mission_executor'          => ['required','string','max:1000'],
            'note'                      => ['nullable' , 'string' , 'max:10000'],
        ];
    }

    public function validated($key = null, $default = null)
    {
        return [
            'name'                      => $this->name,
            't_c'                       => $this->t_c,
            'sub_id'                    => $this->sub_id,
            'sub_username'              => $this->sub_username,
            'subscriber_number'         => $this->subscriber_number,
            'mother'                    => $this->mother,
            'phone'                     => $this->phone,
            'package_start'             => $this->package_start,
            'package_end'               => $this->package_start,
            'package_id'                => $this->package_id,
            'status'                    => $this->status,
            'address'                   => $this->address,
            'installation_address'      => $this->installation_address,
            'mission_executor'          => $this->mission_executor,
            'note'                      => $this->note,
        ];
    }
}
