<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 08.04.2017
 * Time: 19:44
 */

namespace App\Monitoring;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Facade;

/**
 * Class Monitor
 * @package App\Monitoring
 * @method static Collection | MonitoringHost getList()
 * @method static MonitoringHost getDataByID($identifier)
 * @method static schedule(MonitoringHost $monitoringhost, Maintenance $maintenance)
 */
class Monitor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return env("monitoring");
    }
}