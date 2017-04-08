<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 08.04.2017
 * Time: 20:17
 */

namespace App\Monitoring;


class MonitoringHost
{
    private $identifier;
    private $displayName;

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param mixed $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param mixed $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
    }

}