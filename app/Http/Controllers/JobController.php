<?php

namespace App\Http\Controllers;

use App\FailedJob;
use App\Host;
use App\Http\Requests\HostImportJobRequest;
use App\Job;
use App\Jobs\HostImportJob;
use Illuminate\Support\Facades\Artisan;

class JobController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function index()
    {
        $running = Job::all();
        $failed = FailedJob::all();
        return $running->merge($failed);
    }

    public function restart(FailedJob $job)
    {
        Artisan::call("queue:retry", [$job->id]);
    }

    public function importJob(Host $host, HostImportJobRequest $request)
    {
        $job = HostImportJob::getInstance($request->json("type"),
            $host,
            $request->json("username"),
            $request->json("password"),
            $request->json("repeat"));

        $host->job_id = $this->dispatch($job);
        $host->save();
        return $host;
    }

    public function delete(Job $job)
    {

    }
}
