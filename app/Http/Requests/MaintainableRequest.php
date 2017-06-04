<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintainableRequest extends FormRequest
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
            'name' => 'required',
            'desc' => 'required',
            'maintainable_type' => 'required|in:Host,Application',
            'host_id' => 'required_if:maintainable_type,Application|nullable|exists:hosts,id',
            'emails.*' => 'nullable|email',
            'stage' => 'required_if:maintainable_type,Host',
            'owner' => 'required_if:maintainable_type,Host',
            'monitoring' => 'sometimes',
        ];
    }

    protected function getRedirectUrl()
    {
        $url = parent::getRedirectUrl();
        if ($url == route("allMaintainables")) return $url . "#add-" . strtolower($this->get("maintainable_type"));

        $updateURL = route("maintainable", $this->route("maintainable"));
        if (substr($url, 0, strlen($updateURL)) == route("maintainable", $this->route("maintainable"))) {
            if ($this->route()->getName() == "store" . $this->get("maintainable_type")) return $url . "#add-" . strtolower($this->get("maintainable_type"));
        }
        return parent::getRedirectUrl();
    }
}
