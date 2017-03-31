<?php

namespace App\Http\Requests;

use App\Maintenance;

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
            'maintainable.*' => 'required|exists:maintainables,id',
            "reason" => "required"];
    }

    protected function getRedirectUrl()
    {
        return parent::getRedirectUrl() . "#schedule";
    }
}
