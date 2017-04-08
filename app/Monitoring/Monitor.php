<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 08.04.2017
 * Time: 19:44
 */

namespace App\Monitoring;


use Illuminate\Support\Facades\Facade;

class Monitor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return env("monitoring");
    }
}