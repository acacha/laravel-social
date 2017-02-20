<?php

namespace Acacha\LaravelSocial\Services;

/**
 * Class ConfigureSocialLogin.
 *
 * @package Acacha\LaravelSocial\Services
 */
abstract class ConfigureSocialLogin
{
    /**
     * Laravel console commmand.
     *
     * @var
     */
    protected $command;

    /**
     * Info URL about how to register and Oauth Client.
     *
     * @return mixed
     */
    abstract protected function infoURL();

    /**
     * Social network name.
     *
     * @return mixed
     */
    abstract protected function name();

    /**
     * @param \Illuminate\Console\Command $command
     * @return $this
     */
    public function command(\Illuminate\Console\Command $command)
    {
        $this->command = $command;
        return $this;
    }

    /**
     * Run social network configuration.
     */
    public function execute()
    {
        $this->showInfoAboutSocialNetwork();
        $this->obtainOAuthClientData();
    }

    /**
     * Show info about social network
     */
    protected function showInfoAboutSocialNetwork()
    {
        $this->command->info('Configuring social network ' . ucfirst($this->name()) . '...');
        $this->command->info('Please register a new OAuth app for ' . ucfirst($this->name()) .
            '. Go to URL <question>' . $this->infoURL() . '</question>');
        $this->showOptionalAdditionalInfo();
        $this->command->info('Then ask the following questions:');
    }

    /**
     * Obtain OAuth client data.
     */
    protected function obtainOAuthClientData()
    {
        $oauth = resolve(\Acacha\LaravelSocial\Services\OAuthApp::class);
        $oauth->setId(trim($this->command->ask('OAuth client id?')));
        $oauth->setSecret(trim($this->command->ask('OAuth client secret?')));
        $oauth->setRedirectUrl(trim($this->command->ask('OAuth client redirect URL?', $this->getDefaultRedirectURL())));

        $service = resolve(\Acacha\LaravelSocial\Services\LaravelSocialiteService::class);
        $service->app($oauth)->social(strtolower($this->name()))->handle();
        $this->command->info(ucfirst($this->name()) . ' added to config/services.php file');
    }

    /**
     * Default Redirect URL.
     *
     * @return string
     */
    protected function getDefaultRedirectURL()
    {
        return 'http://localhost:8080/auth/' . strtolower($this->name()) . '/callback';
    }

    /**
     * Show (if needed) additional info.
     */
    protected function showOptionalAdditionalInfo()
    {
        return;
    }
}
