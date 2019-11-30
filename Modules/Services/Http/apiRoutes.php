<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/services',
    //'middleware' => ['throttle:5,10'/*, 'auth.admin'*/]
], function (Router $router) {
    $router->get('/', [
        'as' => 'api.services.index',
        'uses' => 'ServicesController@index',
        //'middleware' => 'token-can:page.pages.index',
    ]);
    $router->delete('{services_id}', [
        'as' => 'api.services.destroy',
        'uses' => 'ServicesController@destroy',
        //'middleware' => 'token-can:page.pages.destroy',
    ]);
    $router->post('/', [
        'as' => 'api.services.store',
        'uses' => 'ServicesController@store',
        'middleware' => 'token-can:page.pages.create',
    ]);
    $router->get('{services_id}', [
        'as' => 'api.services.find',
        'uses' => 'ServicesController@find',
        //'middleware' => 'token-can:page.pages.edit',
    ])->where('services','[0-9]+');
    $router->post('{services_id}', [
        'as' => 'api.services.update',
        'uses' => 'ServicesController@update',
        //'middleware' => 'token-can:page.pages.edit',
    ]);
});
