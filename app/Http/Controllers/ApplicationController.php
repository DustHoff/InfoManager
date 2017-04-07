<?php

namespace App\Http\Controllers;

use App\Application;
use App\Http\Requests\MaintainableRequest;

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
        $application = $this->save($request);
        return $this->maintainableController->store($request,$application);
    }

    private function save(MaintainableRequest $request, Application $application = null)
    {
        if ($application == null) $application = new Application;
        $application->host_id=$request->input("host_id");
        $application->save();
        return $application;
    }

    public function update(MaintainableRequest $request, Application $application)
    {
        $application = $this->save($request, $application);
        return $this->maintainableController->update($request,$application->maintainable);
    }

    public function addDependency(Application $application)
    {
        $this->authorize("edit", $application->maintainable);
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
