<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->get('su/{short_url}', [
    'uses' => 'ShortUrlController@index',
    'as' => 'shorturl.front.index',
    //'middleware' => config('asgard.page.config.middleware'),
]);
;
