<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Model;

class LifeCircleTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'services__lifecircle_translations';
}
