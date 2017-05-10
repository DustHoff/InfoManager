<?php

namespace App\Jobs;

use App\Mail\Notification;
use App\Maintenance;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var Maintenance
     */
    private $maintenance;

    /**
     * SendNotification constructor.
     * @param Maintenance $maintenance
     */
    public function __construct(Maintenance $maintenance)
    {
        $this->maintenance = $maintenance;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Job Started");
        Log::info("infected Systems ".count($this->maintenance->infected));
        foreach ($this->maintenance->infected as $maintainable) {
            Log::info("proccess ... ". $maintainable->name." found ".count($maintainable->emails));
            foreach ($maintainable->emails as $email) {
                Mail::to($email->email)->send((new Notification($this->maintenance, $maintainable)));
            }
        }
    }
}
