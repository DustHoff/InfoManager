<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model implements Permissiable
{
    protected $fillable = ["name"];

    public function permissions(){
        return $this->belongsToMany("Permission");
    }

    public function hasPermission($perm)
    {
        foreach ($this->permissions as $permission){
            if($permission->permission == $perm)return true;
        }
        return false;
    }

    public function members(){
        return $this->belongsToMany("User","user_group");
    }

    public function maintainableMembers()
    {
        return $this->belongsToMany("MaintainableGroup", "maintainablegroup_group");
    }
}
