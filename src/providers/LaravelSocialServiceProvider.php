<?php

namespace Acacha\LaravelSocial\Providers;

use Acacha\LaravelSocial\Facades\LaravelSocial;
use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Support\ServiceProvider;

/**
 * Class LaravelSocialServiceProvider.
 */
class LaravelSocialServiceProvider extends ServiceProvider
{
    use DetectsApplicationNamespace;

    /**
     * Register the application services.
     */
    public function register()
    {
        if (!defined('LARAVELSOCIAL_PATH')) {
            define('LARAVELSOCIAL_PATH', realpath(__DIR__.'/../../'));
        }

        if ($this->app->runningInConsole()) {
//            $this->commands([\Acacha\LaravelSocial\Console\TODO::class]);
        }

        $this->app->bind('LaravelSocial', function () {
            return new \Acacha\LaravelSocial\LaravelSocial();
        });

    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->defineRoutes();
//        $this->publishHomeController();
//        $this->publishViews();
    }

    /**
     * Define the AdminLTETemplate routes.
     */
    protected function defineRoutes()
    {
        if (!$this->app->routesAreCached()) {
            $router = app('router');

            $router->group(['namespace' => $this->getAppNamespace().'Http\Controllers'], function () {
                require __DIR__.'/../Http/routes.php';
            });
        }
    }

    /**
     * Publish Home Controller.
     */
    private function publishHomeController()
    {
        $this->publishes(LaravelSocial::homeController(), 'adminlte');
    }

}
