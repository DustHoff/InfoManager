<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index(){
        return view("admin.master",["panel"=>"group"]);
    }

    public function detail(Group $group){
        return view("admin.Group.single",compact("group"));
    }

    public function store(GroupRequest $request){
        $group = $this->save(null,$request->input());
        return redirect()->route("group",compact("group"));
    }

    public function update(GroupRequest $request, Group $group){
        $group = $this->save($group,$request->input());
        return redirect()->route("group",compact("group"));
    }

    /**
     * @param Group|null $group
     * @param array $data
     * @return Group
     */
    private function save(Group $group = null,array $data){
        if($group == null) $group = new Group;
        $group->name = $data["name"];
        $group->permissions->sync($data["permissions"]);
        $group->save();
        return $group;
    }
}
