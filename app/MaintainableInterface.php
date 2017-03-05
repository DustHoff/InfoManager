<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 25.02.2017
 * Time: 11:36
 */

namespace App;

interface MaintainableInterface
{
    /**
     * @return array|Maintainable
     */
    public function infect();
}