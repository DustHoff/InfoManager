<?php

namespace App\Http\Controllers;

use App\Host;
use App\Maintainable;
use Illuminate\Http\Request;

class HostController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function store(){
        $this->validate(request(),[
            "name" => "required|unique:maintainables,name",
            "owner" => "required",
            "zabbix_id" => "integer",
            "stage" => "required|in:".implode(",",Host::STAGE),
            "host_id" => "integer"
        ]);

        $maintainable = Maintainable::create(request(["name"]));
        $host = Host::create(request(["zabbix_id","stage","owner","host_id"]));
        $maintainable->maintainable()->associate($host);
        $maintainable->save();

        return redirect()->route("maintainable", compact("maintainable"));
    }
}
