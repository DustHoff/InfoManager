<?php

namespace App\Http\Controllers;

use App\Host;
use App\Http\Requests\HostRequest;

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

    public function update(HostRequest $request, Host $host)
    {
        $this->authorize("edit", $host->maintainable);
        $host = $this->save($request,$host);

        return $this->maintainableController->update($request,$host->maintainable);
    }

    private function save(HostRequest $request, Host $host = null)
    {
        if($host == null) $host=new Host;
        $host->fill([
            "stage"=>$request->input("stage"),
            "owner"=>$request->input("owner"),
            "host_id" => $request->input("host_id"),
            "address" => $request->input("address")
        ]);
        $host->save();
        return $host;
    }

    public function store(HostRequest $request)
    {
        $host = $this->save($request);
        return $this->maintainableController->store($request, $host);
    }


}
