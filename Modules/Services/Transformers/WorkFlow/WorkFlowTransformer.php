<?php

namespace Modules\Services\Transformers\WorkFlow;

use Illuminate\Http\Resources\Json\Resource;

class WorkFlowTransformer extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'state'=>$this->state,
            'urls' => [
                'delete_url' => route('api.services.workflow.destroy', $this->id),
            ],
        ];
    }
}
