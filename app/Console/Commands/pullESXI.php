<?php

namespace App\Console\Commands;

use App\Host;
use App\Jobs\HostImportJob;
use Illuminate\Console\Command;

class pullESXI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infomanager:pullHosts {type} {host} {user} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $host = Host::query()->findOrFail($this->argument("host"));
        HostImportJob::getInstance($this->argument("type"), $host,
            $this->argument("user"), $this->argument("password"), false)->handle();
    }
}
