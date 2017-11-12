<?php

namespace App;

use App\Traits\HasJSONPayloadRelationTrait;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Job
 * @package App
 * @Method FailedJobs()
 */
class Job extends Model
{
    use HasJSONPayloadRelationTrait;
    protected $table = "jobs";
    protected $appends = ["task", "type"];
    protected $hidden = ["payload"];
    protected $dates = ["available_at", "failed_at"];

    public function getTaskAttribute()
    {
        return $this->task()->getResults();
    }

    public function task()
    {
        return $this->hasJSON("payload");
    }

    public function getTypeAttribute()
    {
        $class = explode("\\", $this->task->displayName);
        return $class[sizeof($class) - 1];
    }

}
