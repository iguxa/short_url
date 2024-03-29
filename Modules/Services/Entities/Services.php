<?php

namespace Modules\Services\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Modules\Services\Http\Services\WorkFlow;

class Services extends Model
{
    protected $table = 'services__services';
    protected $fillable = ['title','description','workflow_id','state','api_url'];
    protected $casts = ['state'=>'bool'];
    public function related_services()
    {
        return $this->belongsToMany(Services::class, 'services__services_related', 'services_id', 'related_services_id');
    }
    public function workflow()
    {
        return $this->belongsTo(WorkFlows::class,'workflow_id','id');
    }

}
