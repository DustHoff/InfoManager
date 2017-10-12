<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Vmwarephp\Vhost;

class pullESXI extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infomanager:pullEsxi {host} {user} {password}';

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
        $vhost = new Vhost($this->argument("host"), $this->argument("user"), $this->argument("password"));
        $virtualMachines = $vhost->findAllManagedObjects('VirtualMachine', 'all');
        dd($virtualMachines);
    }
}
