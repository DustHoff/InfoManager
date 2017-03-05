<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comments";
    protected $fillable=["body"];

    public function maintenance(){
        return $this->belongsTo("Maintenance");
    }

    public function user(){
        return $this->belongsTo("User");
    }
}
