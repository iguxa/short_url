<?php
$test1 = 1;
$test =
    /*'straight'   => [
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
    ]*/
    json_decode(file_get_contents( 'public/results.json'),1)
;
$test1 = [
    'straight'   => [
        'type'          => 'workflow', // or 'state_machine'
        'marking_store' => [
            'type'      => 'multiple_state',
            //'arguments' => ['currentPlace']
        ],
        'supports'      => ['stdClass'],
        'places'        => ['draft', 'review', 'rejected', 'published'],
        'transitions'   => [
            'to_review' => [
                'from' => 'draft',
                'to'   => 'review'
            ],
            'publish' => [
                'from' => 'review',
                'to'   => 'published'
            ],
            'reject' => [
                'from' => 'review',
                'to'   => 'rejected'
            ]
        ],
    ]
];

return $test;
//json_decode(file_get_contents( 'results.json'),1);
