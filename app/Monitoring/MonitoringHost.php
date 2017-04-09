<?php

namespace App\Monitoring;

use Illuminate\Database\Eloquent\Model;

class MonitoringHost extends Model
{
    protected $primaryKey = "identifier";
    public $external = array();
    protected $table = "monitoringhosts";
    protected $fillable = ["identifier"];
    public $timestamps =false;
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if(!empty($attributes))$this->external = Monitor::getDataByID($attributes["identifier"]);
    }

    public function name(){
        return $this->external[env("monitoring_name_field")];
    }
}