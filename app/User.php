<?php

namespace App;

use Adldap\Laravel\Traits\UsesAdldap;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'password',
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    public function maintenance(){
        return $this->hasMany('Maintenance');
    }
}
