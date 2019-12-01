<?php


namespace Modules\Core\Transformers;


use Illuminate\Http\Resources\Json\Resource;

class EntityTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            $request->get('field', 'id') => $this->{$request->get('field', 'id')},
            'title' => $this->title,
        ];
    }
}