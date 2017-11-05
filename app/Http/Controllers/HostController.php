<?php

namespace App\Http\Controllers;

use App\Host;
use App\Http\Requests\MaintainableRequest;

class HostController extends Controller
{
    /**
     * @var MaintainableController
     */
    protected $maintainableController;
    public function __construct(MaintainableController $maintainableController)
    {
        $this->maintainableController = $maintainableController;
        $this->middleware("auth");
    }

    public function update(MaintainableRequest $request, Host $host)
    {
        $this->authorize("edit", $host->maintainable);
        $host = $this->save($request,$host);

        return $this->maintainableController->update($request,$host->maintainable);
    }

    private function save(MaintainableRequest $request, Host $host = null){
        if($host == null) $host=new Host;
        $host->fill([
            "stage"=>$request->input("stage"),
            "owner"=>$request->input("owner"),
            "host_id"=>$request->input("host_id")
        ]);
        $host->save();
        return $host;
    }

    public function store(MaintainableRequest $request)
    {
        $host = $this->save($request);
        return $this->maintainableController->store($request, $host);
    }


}
