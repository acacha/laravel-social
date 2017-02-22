<?php

namespace Acacha\LaravelSocial\Services;

/**
 * Class ConfigureGoogleSocialLogin.
 *
 * @package Acacha\LaravelSocial\Services
 */
class ConfigureGoogleSocialLogin extends ConfigureSocialLogin
{

    /**
     * OAuth client registration info URL.
     *
     * @return string
     */
    protected function infoURL()
    {
        return 'https://console.developers.google.com';
    }

    /**
     * Social network name.
     *
     * @return mixed
     */
    protected function name()
    {
        return 'google';
    }

    /**
     * Show optional additional info.
     */
    protected function showOptionalAdditionalInfo()
    {
        $this->command->info('See step by step tutorial at:');
        $url = 'https://blog.damirmiladinov.com/laravel/laravel-5.2-socialite-google-login.html';
        $this->command->info(' <question>' . $url . '</question>');
        $this->command->info('Remember to enable Google+ API!');
        $this->command->info('More info at:');
        $url = 'https://developers.google.com/identity/sign-in/web/devconsole-project';
        $this->command->info(' <question>' . $url . '</question>');
    }
}
