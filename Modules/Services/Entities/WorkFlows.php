<?php

namespace Modules\Services\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class WorkFlows extends Model
{
    use Translatable;

    protected $table = 'services__workflows';
    public $translatedAttributes = [];
    protected $fillable = [];
}
