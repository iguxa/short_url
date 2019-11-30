<?php

namespace Modules\Services\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Services\Events\Handlers\RegisterServicesSidebar;

class ServicesServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterServicesSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('services', array_dot(trans('services::services')));
            $event->load('workflows', array_dot(trans('services::workflows')));
            $event->load('lifecircles', array_dot(trans('services::lifecircles')));
            $event->load('servicesrelateds', array_dot(trans('services::servicesrelateds')));
            // append translations




        });
    }

    public function boot()
    {
        $this->publishConfig('services', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Services\Repositories\ServicesRepository',
            function () {
                $repository = new \Modules\Services\Repositories\Eloquent\EloquentServicesRepository(new \Modules\Services\Entities\Services());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Services\Repositories\Cache\CacheServicesDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Services\Repositories\WorkFlowsRepository',
            function () {
                $repository = new \Modules\Services\Repositories\Eloquent\EloquentWorkFlowsRepository(new \Modules\Services\Entities\WorkFlows());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Services\Repositories\Cache\CacheWorkFlowsDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Services\Repositories\LifeCircleRepository',
            function () {
                $repository = new \Modules\Services\Repositories\Eloquent\EloquentLifeCircleRepository(new \Modules\Services\Entities\LifeCircle());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Services\Repositories\Cache\CacheLifeCircleDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Services\Repositories\ServicesRelatedRepository',
            function () {
                $repository = new \Modules\Services\Repositories\Eloquent\EloquentServicesRelatedRepository(new \Modules\Services\Entities\ServicesRelated());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Services\Repositories\Cache\CacheServicesRelatedDecorator($repository);
            }
        );
// add bindings




    }
}
