<?php

namespace App\Jobs;

use App\Host;
use App\Traits\RepeatingJobTrait;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ReflectionClass;

abstract class HostImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    const SPACE = "App\\Jobs\\impl\\";
    const TYPES = ["Esxi" => "EsxiHostImportJob"];
    public $esxi;
    public $tries = 2;
    public $repeat;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Host $host, $repeat)
    {
        $this->esxi = $host;
        $this->repeat = $repeat;
    }

    /**
     * @return HostImportJob
     */
    public static function getInstance($type, Host $host, $username, $password, $repeat = false)
    {
        $job = new \ReflectionClass(self::SPACE . $type);
        return $job->newinstance($host, $username, $password, $repeat);
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
        if ($this->repeat) {
            $this->esxi->job_id = $this->reschedule();
        } else {
            $this->esxi->job_id = 0;
        }
        $this->esxi->save();
    }

    public abstract function pullHosts();

    function reschedule()
    {
        $c = new ReflectionClass($this);
        $job = static::getInstance($c->getShortName(), $this->esxi, $this->username, $this->password, true)->delay(Carbon::now()->addHour(1));
        return dispatch($job);
    }
}
