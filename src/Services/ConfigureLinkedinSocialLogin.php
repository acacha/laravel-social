<?php

namespace Acacha\LaravelSocial\Services;

/**
 * Class ConfigureTwitterSocialLogin.
 *
 * @package Acacha\LaravelSocial\Services
 */
class ConfigureLinkedinSocialLogin extends ConfigureSocialLogin
{

    /**
     * OAuth client registration info URL.
     *
     * @return string
     */
    protected function infoURL()
    {
        return 'https://www.linkedin.com/secure/developer';
    }

    /**
     * Social network name.
     *
     * @return mixed
     */
    protected function name()
    {
        return 'linkedin';
    }

    /**
     * Show optional additional info.
     */
    protected function showOptionalAdditionalInfo()
    {
        $this->command->info('Retrieve your api keys at tab (Keys and Access Tokens).');
        $this->command->info("In tab permissions check 'Request email addresses from users' checkbox");
    }
}
