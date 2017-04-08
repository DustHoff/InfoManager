<?php

namespace App\Http\Requests;


use App\Group;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class GroupRequest extends FormRequest
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
            "admin" => "required|boolean",
            "editor" => "required|boolean",
            "schedule" => "required|boolean",
            "maintainablegroups.*" => "required|exists:maintainablegroups,id"
        ];
    }
}
