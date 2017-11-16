<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class installhelper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infomanager:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Installs/Update Infomanager';

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
        $this->callSilent("view:clear");
        $this->callSilent("cache:clear");
        $this->callSilent("migrate");

    }

    private function changeEnvironmentVariable($key, $value)
    {
        $path = base_path('.env');

        if (is_bool(env($key))) {
            $old = env($key) ? 'true' : 'false';
        }

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=" . $old, "$key=" . $value, file_get_contents($path)
            ));
        }
    }
}
