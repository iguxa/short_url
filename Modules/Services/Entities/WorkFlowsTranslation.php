<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Model;

class WorkFlowsTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'services__workflows_translations';
}
