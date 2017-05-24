<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model implements MaintainableInterface
{
    public $timestamps = false;
    protected $table="applications";
    protected $fillable=["host_id"];

    public function host(){
        return $this->belongsTo('Host');
    }

    public function requires(){
        return $this->belongsToMany("Application","application_dependencies","application_id","dependency_id");
    }

    public function infect()
    {
        //return $this->belongsToMany("Application","application_dependencies","dependency_id","application_id");
        $result = array();
        foreach ($this->belongsToMany("Application","application_dependencies","dependency_id","application_id")->get() as $application){
            array_push($result, $application->maintainable);
            $result = array_merge($result,$application->infect());
        }
        return array_unique($result);
    }

    public function delete()
    {
        $this->maintainable()->delete();
        return parent::delete();
    }

    public function maintainable()
    {
        return $this->morphOne('Maintainable', 'maintainable');
    }
}
