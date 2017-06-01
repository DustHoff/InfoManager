<?php

namespace App\Policies;

use App\Maintenance;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaintenancePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) return true;
    }

    public function change(User $user, Maintenance $maintenance)
    {
        if ($user == $maintenance->user) return true;
        foreach ($maintenance->infected as $maintainable) {
            if ($user->can("schedule", $maintainable)) return true;
        }
        return false;
    }
}
