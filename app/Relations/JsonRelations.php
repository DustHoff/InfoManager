<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dustin
 * Date: 29.10.2017
 * Time: 14:56
 */

namespace App\Relations;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class JsonRelations extends Relation
{
    private $field;

    public function __construct(Model $parent, $field)
    {
        parent::__construct($parent->newQuery(), $parent);
        $this->field = $field;
    }

    public function create($data)
    {
        $this->related->setAttribute($this->field, json_encode($data));
    }


    /**
     * Set the base constraints on the relation query.
     *
     * @return void
     */
    public function addConstraints()
    {
    }

    /**
     * Set the constraints for an eager load of the relation.
     *
     * @param  array $models
     * @return void
     */
    public function addEagerConstraints(array $models)
    {
    }

    /**
     * Initialize the relation on a set of models.
     *
     * @param  array $models
     * @param  string $relation
     * @return array
     */
    public function initRelation(array $models, $relation)
    {
    }

    /**
     * Match the eagerly loaded results to their parents.
     *
     * @param  array $models
     * @param  \Illuminate\Database\Eloquent\Collection $results
     * @param  string $relation
     * @return array
     */
    public function match(array $models, Collection $results, $relation)
    {
    }

    /**
     * Get the results of the relationship.
     *
     * @return mixed
     */
    public function getResults()
    {
        return $this->get();
    }

    public function get($columns = ['*'])
    {
        $data = json_decode($this->related->getAttributeValue($this->field));
        $data->data->command = unserialize($data->data->command);
        return $data;
    }


}