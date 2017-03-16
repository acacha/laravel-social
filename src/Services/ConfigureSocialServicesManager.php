<?php

namespace Acacha\LaravelSocial\Services;

use Acacha\LaravelSocial\Contracts\ConfigureSocialServicesFactory as Factory;
use Illuminate\Support\Manager;

/**
 * Class ConfigureSocialServicesManager.
 *
 * @package Acacha\LaravelSocial\Services
 */
class ConfigureSocialServicesManager extends Manager implements Factory
{
    /**
     * Supported social networks.
     *
     * @var array
     */
    public static $socialNetworks = ['Github', 'Facebook','Google','Twitter', 'Linkedin'];

    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     */
    public function __construct($app)
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
        return 'github';
    }

    /**
     * Create an instance of the "github" social provider driver.
     *
     */
    protected function createGithubDriver()
    {
        return new ConfigureGithubSocialLogin();
    }

    /**
     * Create an instance of the "facebook" social provider driver.
     *
     */
    protected function createFacebookDriver()
    {
        return new ConfigureFacebookSocialLogin();
    }

    /**
     * Create an instance of the "google" social provider driver.
     *
     */
    protected function createGoogleDriver()
    {
        return new ConfigureGoogleSocialLogin();
    }

    /**
     * Create an instance of the "twitter" social provider driver.
     *
     */
    protected function createTwitterDriver()
    {
        return new ConfigureTwitterSocialLogin();
    }

    /**
     * Create an instance of the "linkedin" social provider driver.
     *
     */
    protected function createLinkedinDriver()
    {
        return new ConfigureLinkedinSocialLogin();
    }
}
