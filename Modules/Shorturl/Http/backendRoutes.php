<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/shorturl'], function (Router $router) {
    $router->get('/', [
        'as' => 'admin.shorturl.index',
        'uses' => 'ShortUrlController@index',
        //'middleware' => 'can:shorturl.shorturls.index'
    ]);
    $router->get('create', [
        'as' => 'admin.shorturl.create',
        'uses' => 'ShortUrlController@create',
        //'middleware' => 'can:shorturl.shorturls.create'
    ]);

    $router->get('{shorturl_id}/edit', [
        'as' => 'admin.shorturl.edit',
        'uses' => 'ShortUrlController@edit',
        //'middleware' => 'can:shorturl.shorturls.edit'
    ]);
    $router->get('{shorturl_id}/watch', [
        'as' => 'admin.shorturl.watch',
        'uses' => 'ShortUrlController@edit',
        //'middleware' => 'can:shorturl.shorturls.edit'
    ]);
// append

});
