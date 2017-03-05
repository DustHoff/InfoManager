<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Maintainable;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function search(){
        //$this->validate(request(),["search","required"]);
        $maintainables = Maintainable::search(request("search"));

        return view("info.search.list", compact("maintainables"));
    }
}
