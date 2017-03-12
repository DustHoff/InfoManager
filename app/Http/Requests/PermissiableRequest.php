<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class PermissiableRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = Auth::user();
        if ($user instanceof Permissiable) {
            $user->hasPermission(get_class($this));
        } else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public abstract function rules();
}
