<?php

namespace App\Monitoring;

class MonitoringItem
{
    private $attributes = array();

    public function __construct($data)
    {
        $this->attributes = $data;
    }

    public function name()
    {
        return $this->attributes[env("monitoring_name_field")];
    }

    public function identifier()
    {
        return $this->attributes[env("monitoring_identifier_field")];
    }
}