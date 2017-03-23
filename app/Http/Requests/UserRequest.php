<?php

namespace App\Http\Requests;

class UserRequest extends PermissiableRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            "username" => "required",
            "password" => "sometimes|confirmed",
            "group.*" => "sometimes|exists:Groups,id",
            "action" => "required|in:save,delete"
        ];
    }
}
