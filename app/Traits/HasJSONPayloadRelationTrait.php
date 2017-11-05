<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 29.10.2017
 * Time: 12:24
 */

namespace App\Traits;


use App\Relations\JsonRelations;

trait HasJSONPayloadRelationTrait
{
    public function hasJSON($field)
    {
        return new JsonRelations($this, $field);
    }
}