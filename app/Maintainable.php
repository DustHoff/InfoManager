<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Maintainable extends Model implements MaintainableInterface
{
    protected $table="maintainables";
    protected $fillable = ["name","stage"];

    public function scopeSearch(Builder $query,$search){
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
}
