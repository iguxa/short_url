<?php

namespace Modules\Shorturl\Entities;

use Brexis\LaravelWorkflow\Traits\WorkflowTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ShortUrl extends Model
{

    protected $table = 'shorturl__short_url';
    protected $fillable = ['title','description','server','redirect','counter','state'];
    protected $casts = ['state'=>'bool'];

    public function visitors()
    {
        return $this->hasMany(Visitors::class);
    }
    public function workflow()
    {
        return [
            'straight'   => [
                'type'          => 'workflow',
                'marking_store' => [
                    'type' => 'single_state',
                    //'arguments' => ['currentPlace']
                ],
                'supports'      => ['App\Http\Controllers\Controller'],
                'places'        => ['a', 'b', 'c','d','e'],
                'transitions'   => [
                    't1' => [
                        'from' => 'a',
                        'to'   => 'b',

                    ],
                    't2' => [
                        'from' => 'b',
                        'to'   => 'c',
                    ],
                    't3' => [
                        'from' => 'a',
                        'to'   => 'c',
                    ],
                    't4' => [
                        'from' => 'a',
                        'to'   => 'd',
                    ],
                    't5' => [
                        'from' => 'a',
                        'to'   => 'e',
                    ]
                ],
            ]
            ];
    }

}
