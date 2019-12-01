<?php

namespace Modules\Core\Repositories\Eloquent;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Core\Repositories\BaseRepository;

/**
 * Class EloquentCoreRepository
 *
 * @package Modules\Core\Repositories\Eloquent
 */
abstract class EloquentBaseRepository implements BaseRepository
{
    /**
     * @var \Illuminate\Database\Eloquent\Model|\Modules\Core\Eloquent\Model An instance of the Eloquent Model
     */
    protected $model;
    public $default_sorted = 'created_at';

    protected $lists_fields = [
        'title','id'
    ];

    /**
     * @param Model $model
     */
    public function __construct($model = null)
    {
        $this->model = $model;
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function first()
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->first();
        }

        return $this->model->first();
    }
    /**
     * @inheritdoc
     */
    public function find($id)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->find($id);
        }

        return $this->model->find($id);
    }

    public function filter($filters = [])
    {
        if (method_exists($this->model, 'filter')) {
            return $this->model->filter($filters);
        }

        return $this->model->select();
    }

    public function  filterByRequest(Request $request)
    {
        $query = $this->filter($request->all());
        $this->applyOrderByRequest($query, $request);

        $this->applyOrderByRequest($query, $request);

        return $query;
    }

    public function applyOrderByRequest(Builder $query, Request $request)
    {
        if ($request->get('order_by') !== null && $request->get('order') !== 'null') {
            $order = $this->prepareRequestSort($request);
            $query->orderBy($request->get('order_by'), $order);
        }
    }

    /**
     * @inheritdoc
     */
    public function all()
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy($this->default_sorted, 'DESC')->get();
        }

        return $this->model->orderBy($this->default_sorted, 'DESC')->get();
    }

    public function lists(\Closure $query = null)
    {
        /**
         * @var  \Illuminate\Database\Query\Builder $query
         */
        if($query) {
            $query = $query($this->model);
        } else {
            $query = $this->model;
        }
        return $query->pluck($this->lists_fields[0],  $this->lists_fields[1]);
    }

    /**
     * @inheritdoc
     * @deprecated  TODO: Refactor to newQuery()
     */
    public function allWithBuilder() : Builder
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations');
        }

        return $this->model->newQuery();
    }

    public function newQuery() : Builder
    {

        return $this->allWithBuilder();
    }

    /**
     * @inheritdoc
     */
    public function paginate($perPage = 15)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->with('translations')->orderBy($this->default_sorted, 'DESC')->paginate($perPage);
        }

        return $this->model->orderBy($this->default_sorted, 'DESC')->paginate($perPage);
    }

    /**
     * @inheritdoc
     */
    public function create($data)
    {
        return $this->model->create($data);
    }

    /**
     * @inheritdoc
     */
    public function update($model, $data)
    {
        $model->update($data);

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function destroy($model)
    {
        return $model->delete();
    }

    /**
     * @inheritdoc
     */
    public function allTranslatedIn($lang)
    {
        return $this->model->whereHas('translations', function (Builder $q) use ($lang) {
            $q->where('locale', "$lang");
        })->with('translations')->orderBy($this->default_sorted, 'DESC')->get();
    }

    /**
     * @inheritdoc
     */
    public function findBySlug($slug)
    {
        if (method_exists($this->model, 'translations')) {
            return $this->model->whereHas('translations', function (Builder $q) use ($slug) {
                $q->where('slug', $slug);
            })->with('translations')->first();
        }

        return $this->model->where('slug', $slug)->first();
    }

    /**
     * @inheritdoc
     */
    public function findByAttributes(array $attributes)
    {
        $query = $this->buildQueryByAttributes($attributes);

        return $query->first();
    }

    /**
     * @inheritdoc
     */
    public function getByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc')
    {
        $query = $this->buildQueryByAttributes($attributes, $orderBy, $sortOrder);

        return $query->get();
    }

    /**
     * Build Query to catch resources by an array of attributes and params
     * @param  array $attributes
     * @param  null|string $orderBy
     * @param  string $sortOrder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    private function buildQueryByAttributes(array $attributes, $orderBy = null, $sortOrder = 'asc')
    {
        $query = $this->model->query();

        if (method_exists($this->model, 'translations')) {
            $query = $query->with('translations');
        }

        foreach ($attributes as $field => $value) {
            $query = $query->where($field, $value);
        }

        if (null !== $orderBy) {
            $query->orderBy($orderBy, $sortOrder);
        }

        return $query;
    }

    /**
     * @inheritdoc
     */
    public function findByMany(array $ids)
    {
        $query = $this->model->query();

        if (method_exists($this->model, 'translations')) {
            $query = $query->with('translations');
        }

        return $query->whereIn("id", $ids)->get();
    }

    /**
     * @inheritdoc
     */
    public function clearCache()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function where(string $field, $value, string $operator = null)
    {
        if ($operator === null) {
            $operator = '=';
        } else {
            list($value, $operator) = [$operator, $value];
        }

        return $this->model->where($field, $operator, $value);
    }

    /**
     * @inheritdoc
     */
    public function orderBy(string $field, $direction = 'asc')
    {
        return $this->model->orderBy($field, $direction);
    }

    /**
     * @inheritdoc
     */
    public function with($relationships)
    {
        return $this->model->with($relationships);
    }

    /**
     * @inheritdoc
     */
    public function withCount($relationships)
    {
        return $this->model->withCount($relationships);
    }

    /**
     * @inheritdoc
     */
    public function whereIn(string $field, array $values) : Builder
    {
        return $this->model->whereIn($field, $values);
    }

    protected function getModel()
    {
        return $this->model;
    }

    public function prepareRequestSort($request)
    {
        return $request->get('order') === 'ascending' ? 'asc' : 'desc';
    }
    public function findOrfail(int $id)
    {
        return $this->model->findOrfail($id);
    }
}
