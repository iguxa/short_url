<?php

namespace Modules\Services\Http\Services;
use Modules\Services\Http\Services\Contracts\LabelsServices;
use Modules\Beauty\Entities\Offers;

class LabelsRelated implements LabelsServices
{
    protected $model;
    public function __construct(Offers $model)
    {
        $this->model = $model;
    }
    public function sync(array $ids)
    {
        $this->model->related_offers()->sync($ids);
    }
}
