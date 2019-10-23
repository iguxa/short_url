<?php

namespace Modules\Shorturl\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Shorturl\Events\Handlers\RegisterShorturlSidebar;
use Modules\Shorturl\Repositories\ShortUrlRepository;

class ShorturlServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterShorturlSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('shorturls', array_dot(trans('shorturl::shorturls')));
            // append translations

        });
        app('router')->bind('shorturl', function ($title) {
            return app(ShortUrlRepository::class)->findByTitle($title);
        });
        app('router')->bind('shorturl_id', function ($id) {
            return app(ShortUrlRepository::class)->findOrFail($id);
        });
    }

    public function boot()
    {
        $this->publishConfig('shorturl', 'permissions');
        $this->publishConfig('shorturl', 'config');

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
            'Modules\Shorturl\Repositories\ShortUrlRepository',
            function () {
                $repository = new \Modules\Shorturl\Repositories\Eloquent\EloquentShortUrlRepository(new \Modules\Shorturl\Entities\ShortUrl());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Shorturl\Repositories\Cache\CacheShortUrlDecorator($repository);
            }
        );
// add bindings

    }
}
