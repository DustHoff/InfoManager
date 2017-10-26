<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionsRequest;
use App\Option;
use Illuminate\Support\Facades\Cache;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth")->only("update");
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

    public function get($key)
    {
        return Option::query()->where("name", "=", $key)->firstOrFail()->value;
    }

    public function clearCache()
    {
        Cache::flush();
    }

    public function localization()
    {
        $localization = Cache::rememberForever('i18n', function () {
            $lang = config('app.locale');

            $files = glob(resource_path('lang/' . $lang . '/*.php'));

            $i18n = [];

            foreach ($files as $file) {
                $name = basename($file, '.php');
                $i18n[$name] = require $file;
            }

            return $i18n;
        });
        return json_encode($localization);
    }
}
