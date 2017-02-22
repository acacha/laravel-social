<?php

namespace Acacha\LaravelSocial\Services;

/**
 * Class ConfigureTwitterSocialLogin.
 *
 * @package Acacha\LaravelSocial\Services
 */
class ConfigureTwitterSocialLogin extends ConfigureSocialLogin
{

    /**
     * OAuth client registration info URL.
     *
     * @return string
     */
    protected function infoURL()
    {
        return 'https://apps.twitter.com/app/new';
    }

    /**
     * Social network name.
     *
     * @return mixed
     */
    protected function name()
    {
        return 'twitter';
    }

    /**
     * Show optional additional info.
     */
    protected function showOptionalAdditionalInfo()
    {
        $this->command->info('Retrieve your api keys at tab (Keys and Access Tokens).');
        $this->command->info("In tab permissions check 'Request email addresses from users' checkbox".);
    }
}
