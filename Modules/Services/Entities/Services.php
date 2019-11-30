<?php

namespace Modules\Services\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services__services';
    protected $fillable = ['title','description','workflow_id','state'];
    protected $casts = ['state'=>'bool'];

}
