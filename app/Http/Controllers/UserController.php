<?php

namespace App\Http\Controllers;

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

    public function showAll(){
        $users=User::paginate();

        return view("info.user.all",compact("users"));
    }
    public function show(User $user){
        return view("info.user.single",compact("user"));
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
            "username" => "required",
            "password" => "required"
        ]);
        if(Auth::attempt(request(["username","password"]))){
            return redirect()->intended("/maintainable");
        }
        return back();
    }

    public function logout(){
        Auth::logout();
        return redirect()->back();

    }
}
