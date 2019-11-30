<?php

namespace Modules\Services\Entities;

use Illuminate\Database\Eloquent\Model;

class ServicesRelatedTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'services__servicesrelated_translations';
}
