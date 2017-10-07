<?php

namespace App\Providers;

use App\Maintenance;
use App\Monitoring\impl\None;
use App\Monitoring\impl\Zabbix;
use App\Observer\MaintenanceObserver;
use App\Observer\UserObserver;
use App\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            'Host' => 'App\Host',
            'Application' => 'App\Application',
            'Maintainable' => 'App\Maintainable'
        ]);
        User::observe(new UserObserver());
        Maintenance::observe(new MaintenanceObserver());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind("Zabbix", function () {
            return new Zabbix;
        });
        App::bind("None", function () {
            return new None;
        });
    }
}
