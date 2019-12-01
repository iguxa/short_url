<?php

namespace Modules\Services\Http\Services;
use Modules\Services\Http\Services\Contracts\OffersRelatedService;
use Illuminate\Database\Eloquent\Model;


class OffersRelated implements OffersRelatedService
{
    protected $model;
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
    public function addRelated_workflow(array $ids)
    {
        $this->model->related_workflow()->sync($ids);
    }
    public function addRelated_services(array $ids)
    {
        $this->model->related_services()->sync($ids);
    }
    public function addLabels(array $ids)
    {
        $this->model->labels()->sync($ids);
    }
}
