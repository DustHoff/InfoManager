<?php

namespace App\Http\Controllers;

use App\Maintainable;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function search(){
        //$this->validate(request(),["search","required"]);
        $maintainables = Maintainable::search(request("search"))->orderBy("maintainable_type")->paginate();

        return view("info.search.list", compact("maintainables"));
    }
}
