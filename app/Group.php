<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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
}
