<?php

use Illuminate\Routing\Router;
/** @var Router $router */
$router->group([
    'prefix' => '/dashboard',
    //'namespace' => 'Api',
    //'middleware' => ['api.token', 'auth.admin'],
], function (Router $router) {
    $router->get('/entity_widgets', [
        'as' => 'core.api.entity.widgets',
        'uses' => 'CoreController@entityWidgets',
    ]);
    $router->any('/entity_filters', [
        'as' => 'core.api.entity.filters',
        'uses' => 'CoreController@entityFilters',
    ]);
    $router->post('/entity_search', [
        'as' => 'core.api.entity.search',
        'uses' => 'CoreController@entitySearch',
    ]);
    $router->post('/entity_find', [
        'as' => 'core.api.entity.find',
        'uses' => 'CoreController@entityFind',
    ]);
    $router->get('/settlements', [
        'as' => 'core.api.settlement.list',
        'uses' => 'CoreController@settlements',
    ]);
});

