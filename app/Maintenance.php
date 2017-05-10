<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    const TYPE = ['maintenance', 'incident', 'restricted'];
    const STATE = ['announced', 'active', 'inactive'];
    public $timestamps = false;
    protected $table = "maintenances";
    protected $guarded = ['id'];
    protected $dates = ["maintenance_start", "maintenance_end", "start", "end"];
    protected $appends = ["title", "className", "url", "start", "end", "editable", "durationEditable"];

    public function scopeActiveMaintenance(Builder $query)
    {
        return $query->where('state', '=', "active")->paginate();
    }

    public function causedBy()
    {
        return $this->hasOne("Maintainable", "id", "rootcause");
    }
    public function infected()
    {
        return $this->belongsToMany('Maintainable');
    }

    public function comments()
    {
        return $this->hasMany("Comment");#->paginate(10);
    }

    public function user()
    {
        return $this->belongsTo('User');
    }

    /* Calendar Data functions */

    public function getTitleAttribute()
    {
        return __("maintenance." . $this->type) . " " . $this->infected->first()->name;
    }

    public function getClassNameAttribute()
    {
        return $this->type;
    }

    public function getUrlAttribute()
    {
        return route("maintenance", $this);
    }

    public function getStartAttribute()
    {
        return $this->maintenance_start->toDateTimeString();
    }

    public function getEndAttribute()
    {
        return $this->maintenance_end->toDateTimeString();
    }

    public function getEditableAttribute()
    {
        return false;
    }

    public function getDurationEditableAttribute()
    {
        return false;
    }
}
