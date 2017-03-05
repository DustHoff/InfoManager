<?php

namespace App;

use App\Jobs\SendNotification;
use App\Mail\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;

class Maintenance extends Model
{
    protected $table = "maintenances";
    protected $guarded = ['id'];
    public $timestamps = false;
    protected $dates = ["maintenance_start", "maintenance_end"];
    const TYPE = ['Maintenance', 'Incident','Restricted Performance'];
    const STATE = ['announced', 'active', 'inactive'];

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
