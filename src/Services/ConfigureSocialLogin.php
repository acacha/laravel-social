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
     * Laravel console commmand
     *
     * @var
     */
    protected $command;

    /**
     * Supported social networks.
     *
     * @var array
     */
    protected $networks =  ['Github', 'Facebook','Google','Twitter'];

    /**
     * Current selected social network.
     *
     * @var
     */
    protected $socialNetwork;

    /**
     * ConfigureSocialLogin constructor.
     *
     * @param $command
     */
    public function __construct(\Illuminate\Console\Command $command)
    {
        $this->command = $command;
    }

    public function execute()
    {
        $continue = true;
        while ($continue) {
            $this->socialNetwork = $this->command->choice('Which social network you wish to configure?',$this->networks,0);
            $this->runSocialNetworkConfiguration();
            $continue = $this->command->confirm('Do you wish to configure other social networks?',true);
        }
    }

    /**
     * Run social network configuration.
     *
     * @param $name
     */
    protected function runSocialNetworkConfiguration()
    {
        $this->showInfoAboutSocialNetwork();
        $this->obtainOAuthClientData();
    }

    /**
     * Show info about social network
     */
    protected function showInfoAboutSocialNetwork()
    {
        $this->command->info('Configuring social network ' . $this->socialNetwork);
        $this->command->info('Please go to URL <question>' . $this->infoURL() . '</question> and then ask the following questions:');
    }

    protected function obtainOAuthClientData()
    {
        $oauth = resolve(\Acacha\LaravelSocial\Services\OAuthApp::class);
        $oauth->setId(trim($this->command->ask('OAuth client id?')));
        $oauth->setSecret(trim($this->command->ask('OAuth client secret?')));
        $oauth->setRedirectUrl(trim($this->command->ask('OAuth client redirect URL?',$this->getDefaultRedirectURL())));

        $service = resolve(\Acacha\LaravelSocial\Services\LaravelSocialiteService::class);
        $service->app($oauth)->social(strtolower($this->socialNetwork))->handle();
        $this->command->info(ucfirst($this->socialNetwork) . ' added to config/services.php file');
    }

    /**
     * Info URL about how to register and Oauth Client.
     * @return mixed
     */
    abstract protected function infoURL();

    /**
     * Default Redirect URL.
     *
     * @return string
     */
    protected function getDefaultRedirectURL()
    {
       return 'http://localhost:8080/auth/' . strtolower($this->socialNetwork) . '/callback';
    }

}