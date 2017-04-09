<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaintainableGroup extends Model
{
    protected $table = "maintainablegroups";
    protected $fillable = ["name"];
    protected $hidden = ["pivot"];

    public function maintainables()
    {
        return $this->belongsToMany("Maintainable");
    }

    public function groups()
    {
        return $this->belongsToMany("Group");
    }
}
