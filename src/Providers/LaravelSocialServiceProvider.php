<?php

namespace Acacha\LaravelSocial\Providers;

use Acacha\LaravelSocial\Facades\LaravelSocial;
use Acacha\LaravelSocial\Repositories\EloquentSocialUserRepository;
use Acacha\LaravelSocial\Repositories\SocialUserRepository;
use Acacha\LaravelSocial\Services\ConfigureSocialServicesManager;
use Acacha\LaravelSocial\Services\LaravelSocialiteService;
use Acacha\LaravelSocial\Services\OAuthApp;
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
     * Enabled social providers.
     *
     * @var array
     */
    public $enabled = ['Github','Facebook','Google','Twitter'];

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
            $this->commands([\Acacha\LaravelSocial\Console\Commands\MakeSocial::class]);
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

        $this->registerSocialUsersRepository();
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->defineRoutes();
        $this->loadMigrations();
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
        foreach ($this->enabled as $provider) {
            $providerClass =  $provider . 'SocialProvider';
            $this->app->bind($providerClass, function ($app) use ($providerClass) {
                $providerClassWithNamespace = 'Acacha\LaravelSocial\SocialProviders\\' . $providerClass;
                return new $providerClassWithNamespace($app->make('Laravel\Socialite\Contracts\Factory'));
            });
        }
    }

    /**
     * Load migrations.
     */
    private function loadMigrations()
    {
        $this->loadMigrationsFrom( LARAVELSOCIAL_PATH .'/database/migrations');
    }

    /**
     * Register social users repository.
     */
    private function registerSocialUsersRepository()
    {
        $this->app->bind(
            SocialUserRepository::class,
            EloquentSocialUserRepository::class
        );
    }
}
