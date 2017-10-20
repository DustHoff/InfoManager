<?php

namespace App\Http\Controllers;

use App\Email;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function search(Request $request)
    {
        return response()->json(Email::query()->where("email", 'like', '%' . $request->get("email") . '%')->get()->pluck("email"));
    }

    public function store(Request $request)
    {
        if (!$request->isJson()) return redirect()->back();
        $this->validate($request, ['email' => 'required|email']);
        $email = Email::findOrCreate(request('email'));

        return response($email)->json($email);
    }
}
