<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 08.04.2017
 * Time: 19:48
 */

namespace App\Monitoring;


use App\Maintenance;

interface Monitoring
{
    public function listHosts();

    public function schedule(MonitoringHost $host, Maintenance $maintenance);
}