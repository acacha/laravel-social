<?php

namespace Acacha\LaravelSocial\Providers;

use Acacha\LaravelSocial\Facades\LaravelSocial;
use Acacha\LaravelSocial\Services\ConfigureSocialServicesManager;
use Acacha\LaravelSocial\Services\LaravelSocialiteService;
use Acacha\LaravelSocial\Services\OAuthApp;
use Acacha\LaravelSocial\SocialProviders\GithubSocialProvider;
use Acacha\LaravelSocial\SocialProviders\FacebookSocialProvider;
use Acacha\LaravelSocial\SocialProviders\TwitterSocialProvider;
use Acacha\LaravelSocial\SocialProviders\GoogleSocialProvider;
use Acacha\LaravelSocial\SocialProviders\SocialProviderManager;
use Illuminate\Console\DetectsApplicationNamespace;
use Illuminate\Support\ServiceProvider;
use Laravel\Socialite\SocialiteServiceProvider;

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
            $this->commands([\Acacha\LaravelSocial\Console\Commands\Social::class]);
        }

        $this->app->bind('LaravelSocial', function () {
            return new \Acacha\LaravelSocial\LaravelSocial();
        });

        $this->registerSocialiteProvider();

        $this->registerSocialProviderManager();

        $this->registerConfigureSocialServicesManager();

        $this->registerOAuthApp();

        $this->registerSocialProviders();

        $this->registerLaravelSocialiteService();
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->defineRoutes();
//        $this->publishHomeController();
    }

    /**
     * Define the AdminLTETemplate routes.
     */
    protected function defineRoutes()
    {
        if (!$this->app->routesAreCached()) {
            $router = app('router');

            $router->group(['namespace' => 'Acacha\LaravelSocial\Http\Controllers'], function () {
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

    /**
     * Register social provider manager.
     */
    private function registerSocialProviderManager()
    {
        $this->app->singleton(\Acacha\LaravelSocial\Contracts\Factory::class, function ($app) {
            return new SocialProviderManager($app);
        });
    }

    /**
     * Register socialite service provider.
     */
    private function registerSocialiteProvider()
    {
        $this->app->register(SocialiteServiceProvider::class);
    }

    /**
     * Register configure social services manager.
     */
    private function registerConfigureSocialServicesManager()
    {
        $this->app->singleton(\Acacha\LaravelSocial\Contracts\ConfigureSocialServicesFactory::class,
            function ($app) {
                return new ConfigureSocialServicesManager($app);
        });
    }

    /**
     * Register OAuth App.
     */
    private function registerOAuthApp()
    {
        $oauth = new OAuthApp();
        $this->app->instance(\Acacha\LaravelSocial\Services\OAuthApp::class, $oauth);
    }

    /**
     * Register Laravel Socialite service.
     */
    private function registerLaravelSocialiteService()
    {
        $this->app->bind(\Acacha\LaravelSocial\Services\LaravelSocialiteService::class, function ($app) {
            return new LaravelSocialiteService(
                new \Acacha\Filesystem\Compiler\StubFileCompiler(),
                new \Acacha\Filesystem\Filesystem()
            );
        });
    }

    /**
     * Register social providers.
     */
    private function registerSocialProviders()
    {
        $this->app->bind('GithubSocialProvider', function ($app) {
            return new GithubSocialProvider($app->make('Laravel\Socialite\Contracts\Factory'));
        });
        $this->app->bind('FacebookSocialProvider', function ($app) {
            return new FacebookSocialProvider($app->make('Laravel\Socialite\Contracts\Factory'));
        });
        $this->app->bind('TwitterSocialProvider', function ($app) {
            return new TwitterSocialProvider($app->make('Laravel\Socialite\Contracts\Factory'));
        });
        $this->app->bind('GoogleSocialProvider', function ($app) {
            return new GoogleSocialProvider($app->make('Laravel\Socialite\Contracts\Factory'));
        });
    }

}
