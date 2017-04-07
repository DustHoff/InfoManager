<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model implements Permissiable
{
    protected $fillable = ["name"];

    public function members(){
        return $this->belongsToMany("User","user_group");
    }

    public function maintainableMembers()
    {
        return $this->belongsToMany("MaintainableGroup", "maintainablegroup_group");
    }

    public function isEditor(array $maintainablegroup)
    {
        return $this->hasPermission($maintainablegroup) && $this->editor;
    }

    public function hasPermission(array $maintainablegroup)
    {
        return $this->maintainableMembers->whereIn($maintainablegroup)->isNotEmpty();
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function isScheduler(array $maintainableGroup)
    {
        return $this->hasPermission($maintainablegroup) && $this->schedule;
    }
}
