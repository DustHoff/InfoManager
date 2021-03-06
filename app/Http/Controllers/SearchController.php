<?php

namespace App\Http\Controllers;

use App\Email;
use App\Maintainable;
use App\MaintainableGroup;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function search(){
        //$this->validate(request(),["search","required"]);
        $maintainables = Maintainable::search(request("search"))->orderBy("maintainable_type")->orderBy("name")->get();

        return view("info.search.list", compact("maintainables"));
    }

    public function email(Request $request)
    {
        return response()->json(Email::query()->where("email", 'like', '%' . $request->get("email") . '%')->get());
    }

    public function maintainable(Request $request)
    {
        return response()->json(Maintainable::search($request->get("name"))->get());
    }

    public function maintainablegroup(Request $request)
    {
        return response()->json(MaintainableGroup::query()->where("name", "like", '%' . $request->get("name") . '%')->get());
    }
}
