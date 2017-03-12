<?php

namespace App\Http\Requests;

use App\Permissiable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

abstract class PermissiableRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        Log::info("required permission ".get_class($this));
        $user = Auth::user();
        if ($user instanceof Permissiable) {
            if($user->hasPermission(get_class($this))) return true;
        } else return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public abstract function rules();
}
