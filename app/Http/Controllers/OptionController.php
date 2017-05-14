<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionsRequest;
use App\Option;

class OptionController extends Controller
{
    public function update(OptionsRequest $request)
    {
        $this->authorize("administrate", Option::class);
        foreach ($request->input("option") as $key => $value) {
            $option = Option::where(["name" => $key])->firstOrFail();
            $option->value = $value;
            $option->save();
        }
        return back();
    }

    public function get($key)
    {
        return Option::query()->where("name", "=", $key)->firstOrFail()->toJson();
    }
}
