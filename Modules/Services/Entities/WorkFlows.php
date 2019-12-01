<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class WorkFlows extends Model
{
    use NodeTrait;
    protected $table = 'services__workflow';
    protected $fillable = ['title','description','state'];
    protected $casts = ['state'=>'bool'];

    public function related_workflow()
    {
        return $this->belongsToMany(WorkFlows::class, 'services__workflow_related', 'workflow_id', 'related_workflow_id');
    }

    public function services()
    {
        return $this->belongsToMany(Services::class);
    }
}
