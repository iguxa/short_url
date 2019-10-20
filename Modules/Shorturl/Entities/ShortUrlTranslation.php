<?php

namespace Modules\Shorturl\Entities;

use Illuminate\Database\Eloquent\Model;

class ShortUrlTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = [];
    protected $table = 'shorturl__shorturl_translations';
}
