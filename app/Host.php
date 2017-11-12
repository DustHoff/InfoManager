<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Host extends Model implements MaintainableInterface
{
    const STAGE = ["TEST", "QS", "PROD"];
    public $timestamps = false;
    protected $table="hosts";
    protected $fillable = ["zabbix_id", "stage", "owner", "host_id", "address"];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|Application
     */
    public function applications(){
        return $this->hasMany('Application');
    }

    public function runsOn(){
        return $this->belongsTo('Host');
    }

    public function vms(){
        return $this->hasMany('Host');
    }

    public function delete()
    {
        $this->maintainable()->delete();
        return parent::delete();
    }

    public function maintainable()
    {
        return $this->morphOne('Maintainable', "maintainable");
    }

    public function infect()
    {
        $results=array();
        foreach ($this->applications as $application){
            array_push($results, $application->maintainable);
            $results = array_merge($results,$application->infect());
        }
        foreach ($this->vms as $vm){
            array_push($results, $vm->maintainable);
            $results =array_merge($results,$vm->infect());
        }
        return array_unique($results);
    }

    public function task()
    {
        return $this->hasOne("Task", "id", "job_id");
    }
}
