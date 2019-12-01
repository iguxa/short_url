<?php

namespace Modules\Services\Transformers\Services;

use Illuminate\Http\Resources\Json\Resource;

class RelatedServicesFormTransformer  extends Resource
{
    public function toArray($request)
    {
        return $this->id?? [] ;
    }
}
