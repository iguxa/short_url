<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/shorturl'], function (Router $router) {
    $router->bind('shorturl', function ($id) {
        return app('Modules\Shorturl\Repositories\ShortUrlRepository')->find($id);
    });
    $router->get('shorturls', [
        'as' => 'admin.shorturl.shorturl.index',
        'uses' => 'ShortUrlController@index',
        'middleware' => 'can:shorturl.shorturls.index'
    ]);
    $router->get('shorturls/create', [
        'as' => 'admin.shorturl.shorturl.create',
        'uses' => 'ShortUrlController@create',
        'middleware' => 'can:shorturl.shorturls.create'
    ]);
    $router->post('shorturls', [
        'as' => 'admin.shorturl.shorturl.store',
        'uses' => 'ShortUrlController@store',
        'middleware' => 'can:shorturl.shorturls.create'
    ]);
    $router->get('shorturls/{shorturl}/edit', [
        'as' => 'admin.shorturl.shorturl.edit',
        'uses' => 'ShortUrlController@edit',
        'middleware' => 'can:shorturl.shorturls.edit'
    ]);
    $router->put('shorturls/{shorturl}', [
        'as' => 'admin.shorturl.shorturl.update',
        'uses' => 'ShortUrlController@update',
        'middleware' => 'can:shorturl.shorturls.edit'
    ]);
    $router->delete('shorturls/{shorturl}', [
        'as' => 'admin.shorturl.shorturl.destroy',
        'uses' => 'ShortUrlController@destroy',
        'middleware' => 'can:shorturl.shorturls.destroy'
    ]);
// append

});
