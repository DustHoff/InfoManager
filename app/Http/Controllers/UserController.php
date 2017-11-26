<?php

namespace App\Http\Controllers;

use App\Email;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Auth\Access\AuthorizationException;
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
        if (Auth::user() != $user) $this->authorize("administrate", User::class);
        if(!$user) $user = new User;
        $user->name = $request->input("name");
        $user->username = $request->input("username");
        if ($request->has("email")) $user->email()->associate(Email::firstOrCreate(["email" => $request->input("email")]));
        if ($request->input("password")) $user->password = Hash::make($request->input("password"));
        $user->save();
        try {
            $this->authorize("administrate", User::class);
            if ($request->input("group")) $user->groups()->sync($request->input("group"));
        } catch (AuthorizationException $e) {
        }
        return $user;
    }

    public function update(UserRequest $request, User $user)
    {
        if ($request->input("action") == __("menu.save")) {
            $user = $this->save($request, $user);
            return redirect()->route("profile", compact("user"));
        }
        if ($request->input("action") == __("menu.delete")) {
            $this->authorize("administrate", User::class);
            $user->delete();
            return redirect()->route("admin");
        }

    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route("admin");
    }
}
