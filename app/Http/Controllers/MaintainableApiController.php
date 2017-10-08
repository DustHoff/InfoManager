<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 23.05.2017
 * Time: 16:42
 */

namespace App\Http\Controllers;


use App\Maintainable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaintainableApiController
{

    public function showJSON(Request $request)
    {
        $data = collect();
        $maintainables = Maintainable::query()->findMany($request->get("maintainables"));
        $data = $data->merge($maintainables);
        if ($request->get("infected")) {
            foreach ($maintainables as $maintainable) {
                foreach ($maintainable->infect() as $infect)
                    if (Auth::user()->can("view", $infect)) $data->push($infect);
            }
        }
        return response()->json($data->unique("id")->sortBy("maintainable_type"));
    }

    public function showHTML(Maintainable $maintainable)
    {
        return view("info.Maintainable.item", compact("maintainable"));
    }
}