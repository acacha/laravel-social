<?php

namespace Acacha\LaravelSocial\Repositories;

use Acacha\LaravelSocial\Models\SocialUser;
use Acacha\LaravelSocial\Traits\UserModel;

/**
 * Class EloquentSocialUserRepository.
 */
class EloquentSocialUserRepository implements SocialUserRepository
{
    use UserModel;

    /**
     * Social network.
     *
     * @var
     */
    protected $provider;

    /**
     * Return user if exists; create and return if doesn't.
     *
     * @param $socialUser
     * @return User
     */
    public function findOrCreateUser($socialUser)
    {
        if ($authUser = $this->find($socialUser)) {
            return $authUser;
        }
        return $this->createSocialUser($socialUser);
    }

    /**
     * Find social user.
     *
     * @param $socialUser
     * @return mixed
     */
    public function find($socialUser)
    {
        return SocialUser::where('social_id', $socialUser->id)
               ->where('social_type', $this->provider)->first()->user();
    }

    /**
     * Create social user.
     *
     * @param $socialUser
     * @return mixed
     */
    public function createSocialUser($socialUser)
    {
        $user = $this->createUser($socialUser);
        SocialUser::create([
            'user_id'     => $user->id,
            'social_id'   => $socialUser->id,
            'social_type' => $this->provider,
            'nickname'    => $socialUser->nickname,
            'name'        => $socialUser->name,
            'email'       => $socialUser->email,
            'avatar'      => $socialUser->avatar,
        ]);
        return $user;
    }

    /**
     * Returns field name to use at login.
     *
     * @return string
     */
    private function username()
    {
        return config('auth.providers.users.field','email');
    }

    /**
     * Set provider
     *
     * @param $provider
     * @return $this
     */
    public function provider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * Create regular user.
     *
     * @param $socialUser
     * @return mixed
     */
    private function createUser($socialUser)
    {
        $user = [
            'name' => $socialUser->name,
            'email' => $socialUser->email,
        ];
        if ($this->username() === 'username') {
            $user['username'] = $socialUser->nickname;
        }
        $userClass = $this->userModel();
        return $userClass::create($user);
    }
}