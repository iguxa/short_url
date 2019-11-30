<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/services'], function (Router $router) {
    $router->bind('services', function ($id) {
        return app('Modules\Services\Repositories\ServicesRepository')->find($id);
    });
    $router->get('/', [
        'as' => 'admin.services.services.index',
        'uses' => 'ServicesController@index',
        'middleware' => 'can:services.services.index'
    ]);
    $router->get('create', [
        'as' => 'admin.services.services.create',
        'uses' => 'ServicesController@create',
        'middleware' => 'can:services.services.create'
    ]);
    $router->post('/', [
        'as' => 'admin.services.services.store',
        'uses' => 'ServicesController@store',
        'middleware' => 'can:services.services.create'
    ]);
    $router->get('{services}/edit', [
        'as' => 'admin.services.services.edit',
        'uses' => 'ServicesController@edit',
        'middleware' => 'can:services.services.edit'
    ]);
    $router->put('{services}', [
        'as' => 'admin.services.services.update',
        'uses' => 'ServicesController@update',
        'middleware' => 'can:services.services.edit'
    ]);
    $router->delete('{services}', [
        'as' => 'admin.services.services.destroy',
        'uses' => 'ServicesController@destroy',
        'middleware' => 'can:services.services.destroy'
    ]);

// append




});
