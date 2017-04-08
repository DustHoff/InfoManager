<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->can("administrate", Group::class);
    }

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
            "group.*" => "sometimes|exists:groups,id",
            "action" => "required|in:save,delete"
        ];
    }
}
