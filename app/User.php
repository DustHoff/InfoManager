<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements Permissiable
{

    protected $fillable = [
        'name', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token', 'pivot',
    ];

    public function email()
    {
        return $this->belongsTo("Email");
    }

    public function maintenances(){
        return $this->hasMany('Maintenance');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany|Group
     */
    public function groups(){
        return $this->belongsToMany("Group","user_group");
    }

    public function hasPermission(array $maintainablegroup)
    {
        foreach ($this->groups as $group){
            if ($group->hasPermission($maintainablegroup)) return true;
        }
        return false;
    }

    public function isEditor(array $maintainableGroup)
    {
        foreach ($this->groups as $group) {
            if ($group->isEditor($maintainableGroup)) return true;
        }
        return false;
    }

    public function isAdmin()
    {
        foreach ($this->groups as $group) {
            if ($group->isAdmin()) return true;
        }
        return false;
    }

    public function isScheduler(array $maintainableGroup)
    {
        foreach ($this->groups as $group) {
            if ($group->isScheduler($maintainableGroup)) return true;
        }
        return false;
    }
}
