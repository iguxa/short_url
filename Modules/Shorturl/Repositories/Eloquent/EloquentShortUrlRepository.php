<?php

namespace Modules\Shorturl\Repositories\Eloquent;

use Illuminate\Http\Request;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\Shorturl\Repositories\ShortUrlRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentShortUrlRepository extends EloquentBaseRepository implements ShortUrlRepository
{
    public function serverPaginationFilteringFor(Request $request): LengthAwarePaginator
    {
        $pages = $this->allWithBuilder();

        if ($request->get('search') !== null) {
            $term = $request->get('search');
            $pages->whereHas('translations', function ($query) use ($term) {
                $query->where('title', 'LIKE', "%{$term}%");
                $query->orWhere('slug', 'LIKE', "%{$term}%");
            })
                ->orWhere('id', $term);
        }

        if ($request->get('order_by') !== null && $request->get('order') !== 'null') {
            $order = $request->get('order') === 'ascending' ? 'asc' : 'desc';

            if (str_contains($request->get('order_by'), '.')) {
                $fields = explode('.', $request->get('order_by'));

                $pages->with('translations')->join('page__page_translations as t', function ($join) {
                    $join->on('page__pages.id', '=', 't.page_id');
                })
                    ->where('t.locale', locale())
                    ->groupBy('page__pages.id')->orderBy("t.{$fields[1]}", $order);
            } else {
                $pages->orderBy($request->get('order_by'), $order);
            }
        }

        return $pages->paginate($request->get('per_page', 10));
    }

    public function findByTitle($title)
    {
        return $this->model->where('title',$title)->first() ?? abort(404);
    }
    public function create($data)
    {
        $data['title'] = str_random(3);
        $shortUrl =  parent::create($data);
        $shortUrl->title .= $shortUrl->id;
        return $shortUrl->save();
    }
}
