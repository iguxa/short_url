<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Model;

class ServicesTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'services__services_translations';
}
