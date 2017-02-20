<?php

namespace Acacha\LaravelSocial\SocialProviders;

/**
 * Class FacebookSocialProvider.
 *
 * @package Acacha\LaravelSocial\SocialProviders
 */
class FacebookSocialProvider extends SocialProvider
{

    /**
     * Social provider name.
     *
     * @return string
     */
    public function name()
    {
        return 'facebook';
    }
}
