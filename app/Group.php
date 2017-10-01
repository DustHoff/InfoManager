<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model implements Permissiable
{
    protected $fillable = ["name"];
    protected $hidden = ['pivot'];
    protected $with = ["maintainableMembers"];

    public function members(){
        return $this->belongsToMany("User","user_group");
    }

    public function maintainableMembers()
    {
        return $this->belongsToMany("MaintainableGroup", "maintainablegroup_group", "group_id");
    }

    public function isEditor(array $maintainablegroup)
    {
        return $this->hasPermission($maintainablegroup) && $this->editor;
    }

    public function hasPermission(array $maintainablegroup)
    {
        return $this->maintainableMembers->whereIn("id", array_column($maintainablegroup, "id"))->isNotEmpty();
    }

    public function isAdmin()
    {
        return $this->admin;
    }

    public function isScheduler(array $maintainablegroup)
    {
        return $this->hasPermission($maintainablegroup) && $this->schedule;
    }
}
