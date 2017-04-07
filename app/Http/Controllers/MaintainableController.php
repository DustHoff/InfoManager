<?php

namespace App\Http\Controllers;

use App\Email;
use App\Http\Requests\MaintainableRequest;
use App\Maintainable;
use App\MaintainableGroup;
use Illuminate\Database\Eloquent\Model;

class MaintainableController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function showAll()
    {
        $maintainables = Maintainable::paginate();
        return view("info.Maintainable.all", compact("maintainables"));
    }

    public function show(Maintainable $maintainable)
    {
        $this->authorize("view", $maintainable);
        return view("info.Maintainable.single", compact('maintainable'));
    }

    public function update(MaintainableRequest $request, Maintainable $maintainable)
    {
        $maintainable = $this->save($request, $maintainable);
        return redirect()->route("maintainable", compact("maintainable"));
    }

    private function save(MaintainableRequest $request, Maintainable $maintainable = null, Model $model = null)
    {
        if ($maintainable == null) {
            $maintainable = new Maintainable;
        }

        $maintainable->name = $request->input("name");
        $maintainable->desc = $request->input("desc");
        $maintainable->save();
        if ($model != null) {
            $maintainable->maintainable()->associate($model);
        }
        $groups = array();
        if ($request->input("maintainablegroups") != null) {
            foreach ($request->input("maintainablegroups") as $maintainablegroup) {
                if ($maintainablegroup != null) array_push($groups, MaintainableGroup::firstOrCreate(["name" => $maintainablegroup])->id);
            }
        }
        $maintainable->maintainableGroups()->sync($groups);
        $emails = array();
        if ($request->input('emails') != null) {
            foreach ($request->input('emails') as $email) {
                if ($email != null) array_push($emails, Email::firstOrCreate(["email" => strtolower($email)])->id);
            }
        }
        $maintainable->emails()->sync($emails);
        $maintainable->save();

        return $maintainable;
    }
    /**
     * @param MaintainableRequest $request
     * @param Model $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MaintainableRequest $request, Model $model = null)
    {
        $maintainable = $this->save($request, null, $model);
        return redirect()->route("maintainable", compact("maintainable"));
    }
}
