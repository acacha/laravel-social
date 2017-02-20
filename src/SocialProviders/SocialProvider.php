<?php

namespace Acacha\LaravelSocial\SocialProviders;

/**
 * Class SocialProvider.
 *
 * @package Acacha\LaravelSocial
 */
abstract class SocialProvider implements \Acacha\LaravelSocial\Contracts\SocialProvider
{
    /**
     * Laravel Socialite.
     *
     * @var
     */
    public $socialite;

    /**
     * SocialProvider constructor.
     *
     * @param $socialite
     */
    public function __construct(\Laravel\Socialite\Contracts\Factory $socialite)
    {
        $this->socialite = $socialite;
    }


    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect()
    {

        return $this->socialite->driver($this->name())->redirect();
    }

    /**
     * Redirect the user to the authentication page for the provider.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function user()
    {

        return $this->socialite->driver($this->name())->user();
    }

    /**
     * The name of social provider.
     *
     * @return mixed
     */
    abstract function name();
}