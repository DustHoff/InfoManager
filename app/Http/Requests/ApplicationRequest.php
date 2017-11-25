<?php

namespace App\Http\Requests;

class ApplicationRequest extends MaintainableRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'host_id' => 'required|nullable|exists:hosts,id',
        ]);
    }
}
