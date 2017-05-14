<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionsRequest;
use App\Maintainable;
use App\Option;
use Illuminate\Support\Facades\Blade;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

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

    public function get($key, Maintainable $maintainable = null)
    {
        $template = Blade::compileString(Option::query()->where("name", "=", $key)->firstOrFail()->value);

        return view([
            "template" => $template,
        ], compact("maintainable"));
    }
}
