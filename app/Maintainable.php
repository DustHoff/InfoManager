<?php

namespace App;

use App\Monitoring\MonitoringHost;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class Maintainable
 * @package App
 * @Method static Collection Search($search)
 * @Method static Collection FindByIds(array $ids)
 * @Method static Collection WithPermission()
 */
class Maintainable extends Model implements MaintainableInterface
{
    protected $table = "maintainables";
    protected $fillable = ["name", "desc"];
    protected $with = ["emails"];

    public function scopeSearch(Builder $query, $search)
    {
        return $query->where("name", "like", "%" . $search . "%");
    }

    public function scopeWithPermission(Builder $query)
    {
        if (Auth::user()->isAdmin()) {
            return $query;
        }
        $ids = Auth::user()->groups->pluck("maintainableMembers")->collapse()->pluck("id")->all();

        return $query->whereHas("maintainableGroups", function (Builder $query) use ($ids) {
            //dd($query);
            $query->whereIn("maintainablegroups.id", $ids);
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo|MaintainableInterface|Host|Application
     */
    public function maintainable()
    {
        return $this->morphTo();
    }

    public function emails()
    {
        return $this->belongsToMany('Email');
    }

    public function latestMaintenance()
    {
        return $this->maintenances()->where("state", "=", Maintenance::STATE[1]);
    }

    public function maintenances()
    {
        return $this->belongsToMany('Maintenance');
    }

    public function infect()
    {
        return $this->maintainable->infect();
    }

    public function maintainableGroups()
    {
        return $this->belongsToMany("MaintainableGroup", "maintainable_maintainablegroup");
    }
}
