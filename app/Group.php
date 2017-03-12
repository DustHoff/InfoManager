<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model implements Permissiable
{
    protected $fillable = ["name"];

    public function permissions(){
        return $this->belongsToMany("Permission");
    }

    public function hasPermission($permission)
    {
        foreach ($this->permissions() as $permission){
            if($permission->permission == $permission)return true;
        }
        return false;
    }
}
