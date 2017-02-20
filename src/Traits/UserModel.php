<?php

namespace Acacha\LaravelSocial\Traits;

/**
 * Class UserModel.
 *
 * @package Acacha\LaravelSocial\Traits
 */
trait UserModel
{
    /**
     * Get user model (don't suppose is App\User)
     * @return mixed
     */
    protected function userModel() {
        return config('auth.providers.users.model', config('auth.model', 'App\User'));
    }
}