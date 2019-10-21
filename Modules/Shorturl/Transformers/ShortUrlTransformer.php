<?php

namespace Modules\Shorturl\Transformers;

use Illuminate\Http\Resources\Json\Resource;

class ShortUrlTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => route('shorturl.front.index', $this->title),
            'description' => $this->description,
            'created_at' => $this->created_at,
            'redirect' => $this->redirect,
            'counter' => $this->counter,
            'visitors'=>$this->visitors,
            'state'=>$this->state,
            'urls' => [
                'delete_url' => route('api.shorturl.destroy', $this->id),
            ],
        ];
    }
}
