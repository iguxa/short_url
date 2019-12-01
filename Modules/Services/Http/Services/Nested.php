<?php

namespace Modules\Services\Http\Services;

use Modules\Services\Entities\WorkFlows;

class Nested
{
    public function createNode(array $data)
    {
        if ($this->isRoot($data['parent'])) {
            return WorkFlows::create($data);
        }
        return WorkFlows::create($data, $this->getParentById($data['parent']));

    }
    public function sort($model, $parent_id)
    {
        if ($this->isSortable($model, $parent_id)) {
            $this->nestedSort($model, $parent_id);
        }
    }
    public function deleteNode($model)
    {
        return $model->delete();
    }
    /**
     * @param $parent_id
     * @return bool
     */
    protected function isRoot($parent_id): bool
    {
        return is_null($parent_id);
    }

    /**
     * @param $model
     * @param $parent_id
     * @return mixed
     */
    protected function appendToNode(WorkFlows $model, int $parent_id)
    {
        return $this->getParentById($parent_id)->appendNode($model);
    }

    /**
     * @param $model
     * @param $parent_id
     * @return bool
     */
    protected function isSortable($model, $parent_id): bool
    {
        return (bool) ($model->getParentId() != $parent_id);
    }

    /**
     * @param $model
     * @param $parent_id
     */
    protected function nestedSort(WorkFlows $model, $parent_id): void
    {
        if ($this->isRoot($parent_id)) {
            $model->makeRoot()->save();
        } else {
            $this->appendToNode($model, $parent_id);
        }
    }
    protected function getParentById($id)
    {
        return WorkFlows::find($id);
    }
}
