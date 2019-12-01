<?php


namespace Modules\Core\Transformers;


use Illuminate\Http\Resources\Json\Resource;

class SettlementTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'route' => $this->route,
        ];
    }
}