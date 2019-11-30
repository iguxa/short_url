<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/services',
    //'middleware' => ['throttle:5,10'/*, 'auth.admin'*/]
], function (Router $router) {
    $router->get('/', [
        'as' => 'api.services.index',
        'uses' => 'servicesController@index',
        //'middleware' => 'token-can:page.pages.index',
    ]);
    $router->delete('{services_id}', [
        'as' => 'api.services.destroy',
        'uses' => 'servicesController@destroy',
        //'middleware' => 'token-can:page.pages.destroy',
    ]);
    $router->post('/', [
        'as' => 'api.services.store',
        'uses' => 'servicesController@store',
        'middleware' => 'token-can:page.pages.create',
    ]);
    $router->get('{services_id}', [
        'as' => 'api.services.find',
        'uses' => 'servicesController@find',
        //'middleware' => 'token-can:page.pages.edit',
    ])->where('services','[0-9]+');
    $router->post('{services_id}', [
        'as' => 'api.services.update',
        'uses' => 'servicesController@update',
        //'middleware' => 'token-can:page.pages.edit',
    ]);
});
