<?php

namespace App\Http\Requests;

use App\Maintenance;
use App\Permissiable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MaintenanceRequest extends PermissiableRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'maintenance_start' => 'required|date|after_or_equal:today',
            'maintenance_end' => 'required_if:type,' . Maintenance::TYPE[0] . '|after:maintenance_start',
            'type' => 'required|in:' . implode(",", Maintenance::TYPE),
            'maintainable_id' => 'required|exists:maintainables,id',
            "reason" => "required"];
    }
}
