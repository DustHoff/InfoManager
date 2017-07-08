<?php

namespace App\Http\Controllers;

use App\Maintenance;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        return view("info.Maintenance.calendar");
    }

    public function maintenanceFeed(Request $request)
    {
        $start = $request->input("maintenance_start");
        $end = $request->input("maintenance_end");

        return Maintenance::query()//->where("type", "=", Maintenance::TYPE[0])
            ->where("maintenance_start", ">", $start)
            ->where("maintenance_end", "<", $end)->get();
    }
}
