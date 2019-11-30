<?php

namespace Modules\Services\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class LifeCircle extends Model
{
    use Translatable;

    protected $table = 'services__lifecircles';
    public $translatedAttributes = [];
    protected $fillable = [];
}
