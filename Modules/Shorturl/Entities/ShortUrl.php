<?php

namespace Modules\Shorturl\Entities;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{

    protected $table = 'shorturl__short_url';
    public $translatedAttributes = [];
    protected $fillable = ['title','description','server','redirect','counter','state'];
    protected $casts = ['state'=>'bool'];

    public function visitors()
    {
        return $this->hasMany(Visitors::class);
    }
}
