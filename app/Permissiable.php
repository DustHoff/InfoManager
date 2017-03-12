<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 11.03.2017
 * Time: 16:28
 */

namespace App;


interface Permissiable
{
    public function hasPermission($permission);
}