<?php

namespace Modules\Shorturl\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Visitors extends Model
{
    protected $table = 'shorturl__visitors';
    public $translatedAttributes = [];
    protected $fillable = ['description','server','short_url_id'];
    protected $casts = ['server'=>'array'];
    public function shortUrl()
    {
        return $this->belongsTo(ShortUrl::class);
    }
}
