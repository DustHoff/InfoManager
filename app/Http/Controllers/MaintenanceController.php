<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\MaintenanceRequest;
use App\Jobs\SendNotification;
use App\Maintainable;
use App\Maintenance;
use App\Traits\ZabbixScheduleTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class MaintenanceController extends Controller
{
    use ZabbixScheduleTrait;

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function showAll()
    {
        $maintenances = Maintenance::activeMaintenance();
        return view("info.Maintenance.all", compact('maintenances'));
    }

    public function show(Maintenance $maintenance)
    {
        return view('info.Maintenance.single', compact('maintenance'));
    }

    public function showMessage(Maintenance $maintenance)
    {
        return view('email.notification', compact("maintenance"));
    }

    public function store(MaintenanceRequest $request)
    {
        $maintenance = new Maintenance;
        $maintenance->type = $request->input("type");
        $maintenance->maintenance_start = $request->input("maintenance_start");
        if ($maintenance->type == Maintenance::TYPE[0]) $maintenance->maintenance_end = $request->input("maintenance_end");
        $maintenance->user()->associate(Auth::user());
        $maintenance->save();

        foreach ($request->input("maintainable") as $maintainableId) {
            $maintainable = Maintainable::find($maintainableId);
            $maintenance->infected()->attach($maintainable);
            if (request('infect') == 'on') {
                foreach ($maintainable->infect() as $dependency) {
                    $maintenance->infected()->attach($dependency);
                }
            }
        }

        $comment = new Comment;
        $comment->body = $request->input("reason");
        $comment->maintenance()->associate($maintenance);
        $comment->user()->associate(Auth::user());
        $comment->save();
        //$maintenance->comments()->save($comment);
        $maintainable->save();

        if ($maintenance->type != Maintenance::TYPE[0]) return $this->transit($maintenance);
        else $this->dispatch(new SendNotification($maintenance));
        return redirect()->route("maintenance", compact("maintenance"));
    }

    public
    function transit(Maintenance $maintenance)
    {
        if (array_search($maintenance->state, Maintenance::STATE) < count(Maintenance::STATE)) {
            $maintenance->state = Maintenance::STATE[(array_search($maintenance->state, Maintenance::STATE) + 1)];
            if ($maintenance->state == Maintenance::STATE[2]) $maintenance->maintenance_end = Carbon::now();
            $maintenance->save();
            $this->dispatch(new SendNotification($maintenance));
        }

        //parent::transit($maintenance);
        return back();
    }

    public
    function comment(Maintenance $maintenance)
    {
        $this->validate(request(), ["body" => "required"]);
        $comment = new Comment;
        $comment->body = request("body");
        $comment->maintenance()->associate($maintenance);
        $comment->user()->associate(Auth::user());
        $comment->save();
        $this->dispatch(new SendNotification($maintenance));
        return back();
    }

}
