<?php

namespace App\Http\Controllers;

use App\Application;
use App\Http\Requests\MaintainableRequest;
use App\Maintainable;

class ApplicationController extends Controller
{
    protected $maintainableController;
    public function __construct(MaintainableController $maintainableController)
    {
        $this->maintainableController = $maintainableController;
        $this->middleware("auth");
    }

    public function store(MaintainableRequest $request)
    {
        $application = Application::create(["host_id"=>$request->input("host_id")]);

        return $this->maintainableController->store($request,$application);
    }

    public function update(MaintainableRequest $request, Application $application){
        $application->host_id=$request->input("host_id");
        return $this->maintainableController->update($request,$application->maintainable);
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
