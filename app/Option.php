<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function __toString()
    {
        return "" . $this->value;
    }

}
