<?php

namespace App\Http\Requests;

use App\Maintenance;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CommentRequest extends FormRequest
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
        /**
         * @var Maintenance
         */
        $maintenance = Route::current()->parameter("maintenance");
        return [
            "body" => "required",
            "maintenance_end" => "sometimes|nullable|date|after:" . $maintenance->maintenance_end
        ];
    }
}
