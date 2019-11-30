<?php

namespace Modules\Services\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class WorkFlows extends Model
{
    use NodeTrait;
    protected $table = 'services__workflows';
    protected $fillable = [];
}
