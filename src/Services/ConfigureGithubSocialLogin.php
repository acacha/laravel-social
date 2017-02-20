<?php

namespace Acacha\LaravelSocial\Services;

/**
 * Class ConfigureGithubSocialLogin.
 *
 * @package Acacha\LaravelSocial\Services
 */
class ConfigureGithubSocialLogin extends ConfigureSocialLogin
{

    /**
     * OAuth client registration info URL.
     *
     * @return string
     */
    protected function infoURL()
    {
        return 'https://github.com/settings/applications/new';
    }

    /**
     * Social network name.
     *
     * @return mixed
     */
    protected function name()
    {
        return 'github';
    }
}
