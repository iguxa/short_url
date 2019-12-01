<?php

namespace Modules\Services\Transformers\WorkFlow;

use Illuminate\Http\Resources\Json\Resource;

class WorkFlowFormTransformer  extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'created_at' => $this->created_at,
            'state'=>$this->state,
            'parent' => $this->parent_id ?? null,
            'related_workflow'=> $this->related_workflow()->pluck("{$this->getTable()}.id") ?? [],
            'urls' => [
                'delete_url' => route('api.services.workflow.destroy', $this->id),
            ],
        ];
    }
}
