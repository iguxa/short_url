<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->get('su/{shorturl}', [
    'uses' => 'ShortUrlController@index',
    'as' => 'shorturl.front.index',
    //'middleware' => config('asgard.page.config.middleware'),
]);
;
