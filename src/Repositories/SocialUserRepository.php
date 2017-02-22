<?php

namespace Acacha\LaravelSocial\Repositories;

/**
 * Interface SocialUserRepository.
 *
 * @package Acacha\LaravelSocial\Repositories
 */
interface SocialUserRepository
{
    /**
     * Find or create social user.
     *
     * @param $socialUser
     * @return mixed
     */
    public function findOrCreateUser($socialUser);

    /**
     * Find social user.
     *
     * @param $socialUser
     * @return mixed
     */
    public function find($socialUser);

    /**
     * Create social user.
     *
     * @param $socialUser
     * @param $userId
     * @return mixed
     */
    public function createSocialUser($socialUser, $userId);

    /**
     * Set provider.
     *
     * @param $provider
     * @return $this
     */
    public function provider($provider);
}
