<?php

namespace Acacha\LaravelSocial\SocialProviders;

/**
 * Class TwitterSocialProvider.
 *
 * @package Acacha\LaravelSocial\SocialProviders
 */
class TwitterSocialProvider extends SocialProvider
{

    /**
     * Social provider name.
     *
     * @return string
     */
    public function name()
    {
        return 'twitter';
    }
}
