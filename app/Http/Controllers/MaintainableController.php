<?php

namespace App\Http\Controllers;

use App\Application;
use App\Email;
use App\Host;
use App\Maintainable;
use Illuminate\Support\Facades\Validator;

class MaintainableController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function showAll()
    {
        $maintainables = Maintainable::paginate();
        return view("info.maintainable.all", compact("maintainables"));
    }

    public function show(Maintainable $maintainable)
    {
        return view("info.maintainable.single", compact('maintainable'));
    }

    public function update(Maintainable $maintainable)
    {
        $this->validate(request(), [
            'name' => "required"
        ]);
        $maintainable->name = request("name");
        switch ($maintainable->maintainable_type) {
            case "Application":
                $this->updateApplication($maintainable->maintainable()->getResults());
                break;
            case "Host":
                $this->updateHost($maintainable->maintainable()->getResults());
                break;
        }
        $emails = explode(",", request('emails'));
        $this->attachMails($maintainable, $emails);
        $maintainable->save();
        return $this->show($maintainable);
    }

    private function attachMails(Maintainable $maintainable, array $emails)
    {
        $mailids = array();
        foreach ($emails as $email) {
            $validator = Validator::make(["email" => $email], ['email' => 'required|email']);
            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            $mailAdress = Email::firstOrCreate(["email" => $email]);
            array_push($mailids, $mailAdress->id);
        }
        $maintainable->emails()->sync($mailids);
    }

    private function updateHost(Host $host)
    {
        $this->validate(request(), [
            'zabbix_id' => 'required|integer',
            'owner' => 'required',
        ]);
        $host->zabbix_id = request('zabbix_id');
        $host->owner = request('owner');
        $host->stage = request('stage');
        $host->save();
    }

    private function updateApplication(Application $application)
    {

    }
}
