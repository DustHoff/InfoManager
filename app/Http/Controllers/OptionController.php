<?php

namespace App\Http\Controllers;

use App\Http\Requests\OptionsRequest;
use App\Maintainable;
use App\Maintenance;
use App\Option;
use Carbon\Carbon;
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

    public function bladeTranslator()
    {
        $maintainable = new Maintainable;
        $maintainable->name = "Maintainable Name";
        $maintainable->maintainable_type = "MaintainableType";
        $maintenance = new Maintenance;
        $maintenance->maintenance_start = Carbon::now();
        $maintenance->maintenance_end = Carbon::now()->addDay(1);
        $maintenance->maintenance_type = "MaintenanceType";
        $maintenance->reason = "Reason";
        $view = view(["secondsTemplateCacheExpires" => 0,
            "template" => request()->json("template")], compact("maintainable", "maintenance"));

        return response()->json(compact("view"));
    }
}
