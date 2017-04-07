<?php

namespace App\Providers;

use App\Application;
use App\Group;
use App\Host;
use App\Maintainable;
use App\Policies\AdminPolicy;
use App\Policies\MaintainablePolicy;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Maintainable::class => MaintainablePolicy::class,
        User::class => AdminPolicy::class,
        Group::class => AdminPolicy::class,
        Host::class => AdminPolicy::class,
        Application::class => AdminPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
