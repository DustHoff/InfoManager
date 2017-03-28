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
    protected $dates = ["maintenance_start", "maintenance_end"];

    public function scopeActiveMaintenance(Builder $query)
    {
        return $query->where('state', '=', "active")->paginate();
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
}
