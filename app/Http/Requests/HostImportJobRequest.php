<?php

namespace App\Http\Requests;

use App\Jobs\HostImportJob;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class HostImportJobRequest extends FormRequest
{
    public function validationData()
    {
        return $this->json()->all();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "type" => "required|in:" . implode(",", HostImportJob::TYPES),
            "username" => "required",
            "password" => "required"
        ];
    }
}
