<?php

namespace App\Http\Controllers;

use App\Group;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth",["except"=> ["login"]]);
    }

    public function index(){
        return view("admin.master",["panel"=>"user"]);
    }

    public function show(User $user){
        return view("admin.User.single",compact("user"));
    }

    public function store(UserRequest $request){
        $user=$this->save($request);
        return redirect()->route("profile",compact("user"));
    }

    public function update(UserRequest $request, User $user){
        if($request->input("action")=="save"){
            $user = $this->save($request,$user);
            return redirect()->route("profile",compact("user"));
        }
        if($request->input("action")=="delete"){
            $user->delete();
            return redirect()->route("admin");
        }

    }

    private function save(UserRequest $request,User $user = null){
        if(!$user) $user = new User;
        $user->name = $request->input("name");
        $user->username = $request->input("username");
        if($request->input("password"))$user->password = $request->input("password");
        $user->save();
        if($request->input("group"))$user->groups()->sync($request->input("group"));

        return $user;
    }
}
