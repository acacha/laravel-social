<?php

namespace Acacha\LaravelSocial\Contracts;

/**
 * Interface Provider.
 *
 * @package Acacha\LaravelSocial\Contracts
 */
interface SocialProvider
{
    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect();
    /**
     * Get the User instance for the authenticated user.
     *
     * @return \Laravel\Socialite\Contracts\User
     */
//    public function user();
}
