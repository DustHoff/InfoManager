<?php

namespace App\Policies;

use App\Maintainable;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaintainablePolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if ($user->isAdmin()) return true;
    }

    /**
     * Determine whether the user can view the maintainable.
     *
     * @param  \App\User $user
     * @param  \App\Maintainable $maintainable
     * @return mixed
     */
    public function view(User $user, Maintainable $maintainable)
    {
        return $user->hasPermission($maintainable->maintainableGroups()->get(["maintainablegroups.id"])->toArray());
    }

    /**
     * Determine whether the user can update the maintainable.
     *
     * @param  \App\User $user
     * @param  \App\Maintainable $maintainable
     * @return mixed
     */
    public function edit(User $user, Maintainable $maintainable)
    {
        return $user->isEditor($maintainable->maintainableGroups()->get(["maintainablegroups.id"])->toArray());
    }

    public function schedule(User $user, Maintainable $maintainable)
    {
        return $user->isScheduler($maintainable->maintainableGroups()->get(["maintainablegroups.id"])->toArray());
    }
}
