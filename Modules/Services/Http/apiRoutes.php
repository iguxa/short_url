<?php

use Illuminate\Routing\Router;

/** @var Router $router */
$router->group(['prefix' => '/services'/*,'middleware' => ['throttle:5,10', 'auth.admin']*/], function (Router $router) {
    $router->group(['prefix' => '/service',
        //'middleware' => ['throttle:5,10'/*, 'auth.admin'*/]
    ], function (Router $router) {
        $router->bind('services', function ($id) {
            return app('Modules\Services\Repositories\ServicesRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'api.services.service.index',
            'uses' => 'ServicesController@index',
            //'middleware' => 'token-can:page.pages.index',
        ]);
        $router->delete('{services}', [
            'as' => 'api.services.service.destroy',
            'uses' => 'ServicesController@destroy',
            //'middleware' => 'token-can:page.pages.destroy',
        ]);
        $router->post('/', [
            'as' => 'api.services.service.store',
            'uses' => 'ServicesController@store',
            //'middleware' => 'token-can:page.pages.create',
        ]);
        $router->get('{services}', [
            'as' => 'api.services.service.find',
            'uses' => 'ServicesController@find',
            //'middleware' => 'token-can:page.pages.edit',
        ])->where('services','[0-9]+');
        $router->post('{services}', [
            'as' => 'api.services.service.update',
            'uses' => 'ServicesController@update',
            //'middleware' => 'token-can:page.pages.edit',
        ])->where('services','[0-9]+');
        $router->post('updateservices', [
            'as' => 'api.services.service.updateservices',
            'uses' => 'ServicesController@updateServices',
            //'middleware' => 'token-can:page.pages.edit',
        ]);
        $router->get('generate', [
            'as' => 'api.services.service.generate',
            'uses' => 'ServicesController@generate',
            //'middleware' => 'token-can:designer.projects.destroy',
        ]);
        $router->get('getdoc', [
            'as' => 'api.services.service.getdoc',
            'uses' => 'ServicesController@getdoc',
            //'middleware' => 'token-can:designer.projects.destroy',
        ]);
        $router->post('check', [
            'as' => 'api.services.service.check',
            'uses' => 'ServicesController@check',
            //'middleware' => 'token-can:designer.projects.destroy',
        ]);
    });

    $router->group(['prefix' => '/workflow',
        //'middleware' => ['throttle:5,10'/*, 'auth.admin'*/]
    ], function (Router $router) {
        $router->bind('workflow', function ($id) {
            return app('Modules\Services\Repositories\WorkFlowsRepository')->find($id);
        });
        $router->get('/', [
            'as' => 'api.services.workflow.index',
            'uses' => 'WorkFlowController@index',
            //'middleware' => 'token-can:page.pages.index',
        ]);
        $router->delete('{workflow}', [
            'as' => 'api.services.workflow.destroy',
            'uses' => 'WorkFlowController@destroy',
            //'middleware' => 'token-can:page.pages.destroy',
        ]);
        $router->post('/', [
            'as' => 'api.services.workflow.store',
            'uses' => 'WorkFlowController@store',
            //'middleware' => 'token-can:page.pages.create',
        ]);
        $router->get('{workflow}', [
            'as' => 'api.services.workflow.find',
            'uses' => 'WorkFlowController@find',
            //'middleware' => 'token-can:page.pages.edit',
        ])->where('workflow','[0-9]+');
        $router->post('{workflow}', [
            'as' => 'api.services.workflow.update',
            'uses' => 'WorkFlowController@update',
            //'middleware' => 'token-can:page.pages.edit',
        ]);
        $router->get('up/{workflow}', [
            'as' => 'api.services.workflow.up',
            'uses' => 'WorkFlowController@upCategory',
            //'middleware' => 'token-can:designer.projects.destroy',
        ])->where('categories', '[0-9]+');
        $router->get('down/{workflow}', [
            'as' => 'api.services.workflow.down',
            'uses' => 'WorkFlowController@downCategory',
            //'middleware' => 'token-can:designer.projects.destroy',
        ])->where('categories', '[0-9]+');
        $router->get('generate', [
            'as' => 'api.services.workflow.generate',
            'uses' => 'WorkFlowController@generate',
            //'middleware' => 'token-can:designer.projects.destroy',
        ]);
        $router->get('getdoc', [
            'as' => 'api.services.workflow.getdoc',
            'uses' => 'WorkFlowController@getdoc',
            //'middleware' => 'token-can:designer.projects.destroy',
        ]);
    });
});


