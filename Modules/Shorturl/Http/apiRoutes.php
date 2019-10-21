<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/shorturl',
    'middleware' => ['throttle:5,10'/*, 'auth.admin'*/]
], function (Router $router) {
    $router->get('/', [
        'as' => 'api.shorturl.index',
        'uses' => 'ShortUrlController@index',
        //'middleware' => 'token-can:page.pages.index',
    ]);
    $router->delete('{shorturl}', [
        'as' => 'api.shorturl.destroy',
        'uses' => 'ShortUrlController@destroy',
        //'middleware' => 'token-can:page.pages.destroy',
    ]);
    $router->post('/', [
        'as' => 'api.shorturl.store',
        'uses' => 'ShortUrlController@store',
        'middleware' => 'token-can:page.pages.create',
    ]);
    $router->get('find/{shorturl}', [
        'as' => 'api.shorturl.find',
        'uses' => 'ShortUrlController@find',
        //'middleware' => 'token-can:page.pages.edit',
    ]);
    $router->post('{shorturl}', [
        'as' => 'api.shorturl.update',
        'uses' => 'ShortUrlController@update',
        //'middleware' => 'token-can:page.pages.edit',
    ]);
});
