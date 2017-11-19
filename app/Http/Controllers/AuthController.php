<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
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

    public function admin()
    {
        $this->middleware("auth");
        return view("admin.master");
    }
}
