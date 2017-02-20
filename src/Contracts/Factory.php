<?php

namespace Acacha\LaravelSocial\Contracts;

/**
 * Interface Factory.
 *
 * @package Laravel\Socialite\Contracts
 */
interface Factory
{
    /**
     * Get a SocialProvider implementation.
     *
     * @param  string  $driver
     * @return \Acacha\LaravelSocial\Contracts\SocialProvider
     */
    public function driver($driver = null);
}