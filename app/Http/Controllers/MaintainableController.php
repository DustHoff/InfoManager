<?php

namespace App\Http\Controllers;

use App\Email;
use App\Http\Requests\MaintainableRequest;
use App\Maintainable;
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
        return view("info.Maintainable.single", compact('maintainable'));
    }

    public function update(MaintainableRequest $request, Maintainable $maintainable)
    {

        $maintainable->name = $request->input("name");
        $emails = array();
        foreach ($request->input('emails') as $email) {
            if($email!=null)array_push($emails, Email::firstOrCreate(["email" => $email])->id);
        }
        $maintainable->emails()->sync($emails);
        $maintainable->save();
        return redirect()->route("maintainable",compact("maintainable"));
    }

    /**
     * @param MaintainableRequest $request
     * @param Model $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(MaintainableRequest $request, Model $model){
        $maintainable = Maintainable::create(["name"=>$request->input("name")]);
        $maintainable->maintainable()->associate($model);
        $maintainable->save();
        return redirect()->route("maintainable", compact("maintainable"));
    }
}
