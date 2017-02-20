<?php

namespace Acacha\LaravelSocial\SocialProviders;

/**
 * Class GoogleSocialProvider.
 *
 * @package Acacha\LaravelSocial\SocialProviders
 */
class GoogleSocialProvider extends SocialProvider
{

    /**
     * Social provider name.
     *
     * @return string
     */
    public function name()
    {
        return 'google';
    }
}