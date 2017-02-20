<?php

namespace Acacha\LaravelSocial\SocialProviders;

/**
 * Class GithubSocialProvider.
 *
 * @package Acacha\LaravelSocial\SocialProviders
 */
class GithubSocialProvider extends SocialProvider
{

    /**
     * Social provider name.
     *
     * @return string
     */
    public function name()
    {
        return 'github';
    }
}