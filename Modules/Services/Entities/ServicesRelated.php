<?php

namespace Modules\Services\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ServicesRelated extends Model
{
    use Translatable;

    protected $table = 'services__servicesrelateds';
    public $translatedAttributes = [];
    protected $fillable = [];
}
