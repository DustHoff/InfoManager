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
        $host->update([
            "zabbix_id"=>$request->input("zabbix_id"),
            "stage"=>$request->input("stage"),
            "owner"=>$request->input("owner"),
            "host_id"=>$request->input("host_id")
            ]);

        return $this->maintainableController->update($request,$host->maintainable);
    }

    public function store(MaintainableRequest $request)
    {

        $host = Host::create([
            "zabbix_id"=>$request->input("zabbix_id"),
            "stage"=>$request->input("stage"),
            "owner"=>$request->input("owner"),
            "host_id"=>$request->input("host_id")]);
        return $this->maintainableController->store($request, $host);
    }
}
