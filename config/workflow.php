<?php

return /*[
    'straight'   => [
        'type'          => 'workflow',
        'marking_store' => [
            'type' => 'single_state',
            //'arguments' => ['currentPlace']
        ],
        'supports'      => ['App\Http\Controllers\Controller'],
        'places'        => ['a', 'b', 'c'],
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
            ]
        ],
    ]
]*/ (new \Modules\Shorturl\Entities\ShortUrl())->workflow();
