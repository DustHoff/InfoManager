<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\GroupRequest;

class GroupController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function detail(Group $group){
        return view("admin.Group.single",compact("group"));
    }

    public function store(GroupRequest $request){
        $group = $this->save(null, $request);
        return redirect()->route("group",compact("group"));
    }

    /**
     * @param Group|null $group
     * @param array $data
     * @return Group
     */
    private function save(Group $group = null, GroupRequest $request)
    {
        if($group == null) $group = new Group;
        $group->name = $request->input("name");
        $group->admin = $request->input("admin") != null ? true : false;
        $group->editor = $request->input("editor") != null ? true : false;
        $group->schedule = $request->input("schedule") != null ? true : false;
        $group->save();
        $group->maintainableMembers()->sync($request->input(["maintainablegroups"]));
        return $group;
    }

    public function update(GroupRequest $request, Group $group)
    {
        $group = $this->save($group, $request);
        if ($request->input("action") == __("menu.delete")) {
            $group->delete();
            return redirect()->route("admin");
        }
        return redirect()->route("group", compact("group"));
    }
}
