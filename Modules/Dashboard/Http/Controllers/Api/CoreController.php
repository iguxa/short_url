<?php

namespace Modules\Dashboard\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Core\Contracts\Model\Filterable;
use Modules\Dashboard\Events\BuildingEntityWidgets;
use Modules\Core\Repositories\SettlementRepository;
use Modules\Core\Transformers\EntityTransformer;
use Modules\Core\Transformers\FilterTransformer;
use Modules\Core\Transformers\SettlementTransformer;

class CoreController extends Controller
{
    public function entityWidgets(Request $request)
    {
        event($event = new BuildingEntityWidgets($request->get('entity'), $request->get('entity_id')));
        return $event->getWidgets();
    }

    public function entitySearch(Request $request)
    {
        $class = '\\' . ltrim($request->get('entity'), '/');
        $entity = new $class;
        if (method_exists($entity, 'scopeSearchByRequest')) {
            $query = $entity->searchByRequest($request->get('q'), $request->get('additional'));
        } elseif (method_exists($entity, 'scopeSearch')) {
            $query = $entity->search($request->get('q'));
        } else {
            $query = $entity->where('title', 'like', '%' . $request->get('q') . '%');
        }
        return EntityTransformer::collection($query->limit(10)->get());
    }

    public function entityFind(Request $request)
    {
        $entityId = $request->get('entity_id');
        if(!is_array($entityId)) {
            $entityId = [$entityId];
        }
        $class = '\\'.ltrim($request->get('entity'), '/');
        $entity = new $class;
        $field = $request->get('field', 'id');
        if(method_exists($entity, 'scopeFindByField')) {
            $query = $entity->findByField($entityId, $field);
        } else {
            $query = $entity->whereIn($field, $entityId);
        }
        return EntityTransformer::collection($query->get());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Exception
     */
    public function entityFilters(Request $request)
    {
        $modelClass = $request->get('entity');
        $model = new $modelClass;
        if(!($model instanceof Filterable)) {
            throw new \Exception('Entity is not filterable');
        }
        return FilterTransformer::collection($model->getModelFilters());
    }

    public function settlements(Request $request, SettlementRepository $repository)
    {
        return SettlementTransformer::collection($repository->getByRouter($request->get('router')));
    }
}
