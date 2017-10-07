<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 07.10.2017
 * Time: 17:59
 */

namespace App\Monitoring\impl;


use App\Maintenance;
use App\Monitoring\Monitoring;

class None implements Monitoring
{

    public function getList()
    {
        return array();
    }

    public function getDataByID($identifier)
    {
        return array();
    }

    public function schedule(Maintenance $maintenance)
    {
    }

    public function deleteSchedule(Maintenance $maintenance)
    {

    }
}