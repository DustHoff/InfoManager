<?php

namespace App\Http\Requests;

class HostRequest extends MaintainableRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'stage' => 'required',
            'owner' => 'required',
            'address' => 'sometimes'
        ]);
    }
}
