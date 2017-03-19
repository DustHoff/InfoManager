<?php

namespace App\Http\Requests;


class GroupRequest extends PermissiableRequest
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
            "permissions.*" => "required|exists:permissions,id"
        ];
    }
}
