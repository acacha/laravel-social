<?php

namespace Acacha\LaravelSocial\Services;

/**
 * Class ConfigureFacebookSocialLogin.
 *
 * @package Acacha\LaravelSocial\Services
 */
class ConfigureFacebookSocialLogin extends ConfigureSocialLogin
{

    /**
     * OAuth client registration info URL.
     *
     * @return string
     */
    protected function infoURL()
    {
        return 'https://developers.facebook.com/apps/';
    }

    /**
     * Social network name.
     *
     * @return mixed
     */
    protected function name()
    {
        return 'facebook';
    }

    /**
     * Show optional additional info.
     */
    protected function showOptionalAdditionalInfo()
    {
        $this->command->info('Press button <question>Add new App</question>.');
    }
}
