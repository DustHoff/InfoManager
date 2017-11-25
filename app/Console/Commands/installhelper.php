<?php

namespace App\Console\Commands;

use App\Email;
use App\Group;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class installhelper extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infomanager:install {{--clean}}';

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
        $this->info("Enable Maintenance Mode");
        $this->callSilent("down");
        $this->info("Run some Optimizations");
        $this->callSilent("key:generate");
        $this->call("optimize");
        $this->info("Update Database Schema");
        if ($this->option("clean")) {
            $this->call("migrate:refresh");
        } else {
            $this->call("migrate");
        }
        $user = User::query()->where("username", "=", "admin")->first();
        if ($user == null) {
            $this->info("Create Administrator User");
            $email = new Email;
            $email->email = $this->ask("Administrator E-Mail Address?");
            $email->save();

            $group = new Group;
            $group->name = "Administrator";
            $group->admin = true;
            $group->save();

            $user = new User;
            $user->name = "Administrator";
            $user->username = "admin";
            $user->email()->associate($email);
            $user->password = Hash::make($this->secret("Administrator Password?"));
            $user->save();
            $user->groups()->attach($group->id);
        }
        $this->info("Disable Maintenance Mode");
        $this->callSilent("up");
    }

    private function setenv($key, $value)
    {
        $path = base_path('.env');

        if (is_bool(env($key))) {
            $old = env($key) ? 'true' : 'false';
        } else $old = env($key);

        if (file_exists($path)) {
            file_put_contents($path, str_replace(
                "$key=" . $old, "$key=" . $value, file_get_contents($path)
            ));
        }
    }
}
