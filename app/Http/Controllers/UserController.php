<?php

namespace App\Http\Controllers;

use App\Group;
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

    public function store(){
        $this->validate(request(),[
            "name" => "required|unique:users,name",
            "password" => "required|confirmed"
        ]);
        $user = User::create(["name"=>request("name"),"password"=>Hash::make(request("password"))]);

        return redirect()->route("user",compact("user"));
    }

    public function login(){
        if(!Auth::guest())return redirect()->route("allMaintainables");
        if(request()->isMethod("get"))return view("auth.login");
        $this->validate(request(),[
            "name" => "required",
            "password" => "required"
        ]);
        if(Auth::attempt([
            "username" => request("name"),
            "password"=> request("password")
        ])){
            return redirect()->intended("/maintainable");
        }
        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect()->back();

    }
}
