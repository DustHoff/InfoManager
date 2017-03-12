<?php

namespace App;

use Adldap\Laravel\Traits\UsesAdldap;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable implements Permissiable
{
    protected $fillable = [
        'name', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function maintenances(){
        return $this->hasMany('Maintenance');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Group
     */
    public function groups(){
        return $this->belongsToMany("Group","user_group");
    }

    public function hasPermission($permission)
    {
        foreach ($this->groups as $group){
            if ($group->hasPermission($permission))return true;
        }
        return false;
    }
}
