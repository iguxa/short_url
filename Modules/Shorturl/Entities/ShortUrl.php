<?php

namespace Modules\Shorturl\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{
    use Translatable;

    protected $table = 'shorturl__shorturls';
    public $translatedAttributes = [];
    protected $fillable = [];
}
