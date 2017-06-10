<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 10.06.2017
 * Time: 09:43
 */

namespace App\Observer;

use App\Jobs\UserCreated;
use App\User;
use Illuminate\Foundation\Bus\DispatchesJobs;

class UserObserver
{
    use DispatchesJobs;

    public function created(User $user)
    {
        $this->dispatch(new UserCreated($user));
    }

}