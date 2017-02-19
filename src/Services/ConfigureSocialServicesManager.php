<?php

namespace Acacha\LaravelSocial\Services;

use Acacha\LaravelSocial\Contracts\Factory;
use Illuminate\Support\Manager;

/**
 * Class ConfigureSocialServicesManager.
 *
 * @package Acacha\LaravelSocial\Services
 */
class ConfigureSocialServicesManager extends Manager implements Factory
{
    /**
     * Laravel command
     * @var \Illuminate\Console\Command
     */
    protected $command;

    /**
     * Create a new manager instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
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
        return new ConfigureGithubSocialLogin($this->command);
    }

    /**
     * @param \Illuminate\Console\Command $command
     * @return $this
     */
    public function command(\Illuminate\Console\Command $command)
    {
        $this->command = $command;
        return $this;
    }
}