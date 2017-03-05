<?php

namespace App\Http\Controllers;

use App\Application;
use App\Maintainable;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function store()
    {
        $this->validate(request(), [
            "name" => "required|unique:maintainables,name",
            "host_id" => "required|integer|exists:hosts,id"]);

        $maintainable = Maintainable::create(request(["name"]));
        $application = Application::create(request(["host_id"]));
        $maintainable->maintainable()->associate($application);
        $maintainable->save();

        return redirect()->route("maintainable", compact("maintainable"));
    }

    public function addDependency(Application $application)
    {
        $this->validate(request(), [
            "dependency" => "required|integer|exists:applications,id|not_in:" . $application->id
        ]);
        $application->requires()->attach(request("dependency"));
        return back();
    }

    public function removeDependency(Application $application, Application $dependency)
    {
        $application->requires()->detach($dependency);
        return back();
    }
}
