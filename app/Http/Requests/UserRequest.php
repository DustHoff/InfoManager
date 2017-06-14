<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
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
            "name" => "required",
            "username" => "required",
            "email" => "nullable|email",
            "password" => "sometimes|confirmed",
            "group.*" => "sometimes|exists:groups,id",
            "action" => "required|in:" . __("menu.save") . "," . __("menu.delete")
        ];
    }
}
