<?php

namespace App\Jobs;

use App\Group;
use App\Mail\AdministrateUser;
use App\Mail\ChangePassword;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class UserCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    /**
     * Create a new job instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (isset($this->user->email)) {
            Mail::to($this->user->email)->send(new ChangePassword($this->user));
        }
        //todo: notify Administrators
        $admins = Group::find(1)->members;
        foreach ($admins as $admin) {
            if (isset($admin->email)) Mail::to($admin->email)->send(new AdministrateUser($this->user));
        }
    }
}
