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
    /**
     * @param array|MaintainableGroup $maintainableGroup
     * @return boolean
     */
    public function hasPermission(array $maintainableGroup);

    public function isEditor(array $maintainableGroup);

    public function isScheduler(array $maintainableGroup);

    public function isAdmin();

}