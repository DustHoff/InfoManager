<?php

namespace App;

use App\Monitoring\MonitoringHost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Maintainable extends Model implements MaintainableInterface
{
    protected $table="maintainables";
    protected $fillable = ["name","desc"];

    public function scopeSearch(Builder $query, $search){
        return $query->where("name","like","%".$search."%")->paginate();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo|MaintainableInterface|Host|Application
     */
    public function maintainable(){
        return $this->morphTo();
    }

    public function emails(){
        return $this->belongsToMany('Email');
    }

    public function latestMaintenance(){
        return $this->maintenances()->where("state","=",Maintenance::STATE[1]);
    }

    public function maintenances(){
        return $this->belongsToMany('Maintenance');
    }

    public function infect()
    {
        return $this->maintainable->infect();
    }

    public function maintainableGroups()
    {
        return $this->belongsToMany("MaintainableGroup", "maintainable_maintainablegroup");
    }
}
