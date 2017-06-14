<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function show(User $user){
        return view("admin.User.single",compact("user"));
    }

    public function store(UserRequest $request){
        $user=$this->save($request);
        return redirect()->route("profile",compact("user"));
    }

    private function save(UserRequest $request, User $user = null){
        $this->authorize("administrate", User::class);
        if(!$user) $user = new User;
        $user->name = $request->input("name");
        $user->username = $request->input("username");
        $user->email = $request->input("email");
        if ($request->input("password")) $user->password = Hash::make($request->input("password"));
        $user->save();
        if (Auth::user()->can("administrate", Group::class)) {
            if ($request->input("group")) $user->groups()->sync($request->input("group"));
        }
        return $user;
    }

    public function update(UserRequest $request, User $user)
    {
        if(Auth::user() != $user) $this->authorize("administrate", User::class);
        if ($request->input("action") == __("menu.save")) {
            $user = $this->save($request, $user);
            return redirect()->route("profile", compact("user"));
        }
        if ($request->input("action") == __("menu.delete")) {
            $user->delete();
            return redirect()->route("admin");
        }

    }
}
