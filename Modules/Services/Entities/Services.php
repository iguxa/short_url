<?php

namespace Modules\Services\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use Translatable;

    protected $table = 'services__services';
    public $translatedAttributes = [];
    protected $fillable = [];
}
