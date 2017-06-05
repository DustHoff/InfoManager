<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class checkMailConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infomanager:checkEmail {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'infomanager:checkEmail {email}';

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
        $email = $this->argument("email");

        Mail::raw("TestMail", function ($message) use ($email) {
            $message->to($email);
        });
    }
}
