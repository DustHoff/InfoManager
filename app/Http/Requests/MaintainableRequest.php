<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MaintainableRequest extends PermissiableRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'desc' => 'required',
            'maintainable_type' => 'required|in:Host,Application',
            'host_id' => 'nullable|exists:hosts,id',
            'emails.*' => 'nullable|email',
            'stage' => 'required_if:maintainable_type,Host',
            'owner' => 'required_if:maintainable_type,Host',
            'zabbix_id' => 'required_if:maintainable_type,Host|integer',
        ];
    }
}
