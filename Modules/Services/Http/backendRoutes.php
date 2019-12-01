<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/services'], function (Router $router) {
    $router->group(['prefix' =>'/service'], function (Router $router) {
        $router->get('/', [
            'as' => 'admin.services.service.index',
            'uses' => 'ServicesController@index',
            //'middleware' => 'can:services.services.index'
        ]);
        $router->get('create', [
            'as' => 'admin.services.service.create',
            'uses' => 'ServicesController@create',
            //'middleware' => 'can:services.services.create'
        ]);
        $router->get('{services}/edit', [
            'as' => 'admin.services.service.edit',
            'uses' => 'ServicesController@edit',
            //'middleware' => 'can:services.service.edit'
        ]);
    });
    $router->group(['prefix' =>'/workflow'], function (Router $router) {
        $router->get('/', [
            'as' => 'admin.services.workflow.index',
            'uses' => 'ServicesController@index',
            //'middleware' => 'can:services.services.index'
        ]);
        $router->get('create', [
            'as' => 'admin.services.workflow.create',
            'uses' => 'ServicesController@create',
            //'middleware' => 'can:services.services.create'
        ]);
        $router->get('{services}/edit', [
            'as' => 'admin.services.workflow.edit',
            'uses' => 'ServicesController@edit',
            //'middleware' => 'can:services.services.edit'
        ]);
        $router->get('generate', [
            'as' => 'admin.services.workflow.generate',
            'uses' => 'ServicesController@index',
            //'middleware' => 'can:services.services.edit'
        ]);
    });
});

