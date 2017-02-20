<?php

namespace Acacha\LaravelSocial\SocialProviders;

use Acacha\LaravelSocial\Contracts\Factory;
use Illuminate\Support\Manager;

/**
 * Class SocialProviderManager.
 *
 * @package Acacha\LaravelSocial\SocialProviders
 */
class SocialProviderManager extends Manager implements Factory
{

     /**
     * SocialProviderManager constructor.
     *
     * @param \Illuminate\Foundation\Application $app
     */
    public function __construct(\Illuminate\Foundation\Application $app)
    {
        parent::__construct($app);
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return $this->app['config']['social.provider'];
    }

    /**
     * Create an instance of the "github" social provider driver.
     *
     */
    protected function createGithubDriver()
    {
        return $this->buildProvider('github');
    }

    /**
     * Create an instance of the "facebook" social provider driver.
     *
     */
    protected function createFacebookDriver()
    {
        return $this->buildProvider('facebook');
    }

    /**
     * Create an instance of the "google" social provider driver.
     *
     */
    protected function createGoogleDriver()
    {
        return $this->buildProvider('google');
    }

    /**
     * Create an instance of the "twitter" social provider driver.
     *
     */
    protected function createTwitterDriver()
    {
        return $this->buildProvider('twitter');
    }

    /**
     * Build provider.
     *
     * @param $provider
     * @return SocialProvider
     */
    public function buildProvider($provider)
    {
        return resolve($this->getProvider($provider));
    }

    /**
     * Get provider.
     *
     * @param $provider
     * @return string
     */
    private function getProvider($provider)
    {
        return $provider = ucfirst($provider) . 'SocialProvider';
    }

}