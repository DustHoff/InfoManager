<?php

namespace App\Jobs;

use App\Host;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class HostImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $esxi;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Host $host)
    {
        $this->esxi = $host;
    }

    /**
     * @return HostImportJob
     */
    public static function getInstance(Host $host, $username, $password)
    {
        $job = new \ReflectionClass("App\Jobs\impl\\" . env("importjob", "EsxiHostImportJob"));
        return $job->newinstance($host, $username, $password);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    function handle()
    {
        $vms = $this->pullHosts();

        foreach ($vms as $vm) {
            $host = Host::firstOrNew(["uuid" => $vm["uuid"]]);
            $host->uuid = $vm["uuid"];
            $host->host_id = $this->esxi->id;
            if (!isset($host->id)) {
                $host->stage = Host::STAGE[0];
                $host->owner = "";
                $host->save();
                $host->maintainable()->create(["name" => $vm["name"], "desc"]);
                //TODO: send notification
            } else {
                $maintainable = $host->maintainable;
                $maintainable->name = $vm["name"];
                $maintainable->save();
            }
            $host->save();
        }
    }

    public abstract function pullHosts();
}
