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
            if ($user = $authUser->user) {
                return $user ;
            }
            return $this->createUser($socialUser);
        }

        $userClass = $this->userModel();
        if ($user = $userClass::where('email', $socialUser->email)->first()) {
            $this->createSocialUser($socialUser, $user->id);
            return $user;
        }
        $user = $this->createUser($socialUser);
        $this->createSocialUser($socialUser, $user->id);
        return $user;
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
               ->where('social_type', $this->provider)->first();
    }

    /**
     * Create social user.
     *
     * @param $socialUser
     * @param $userId
     * @return mixed
     */
    public function createSocialUser($socialUser, $userId)
    {
        return SocialUser::create([
            'user_id'     => $userId,
            'social_id'   => $socialUser->id,
            'social_type' => $this->provider,
            'nickname'    => $socialUser->nickname,
            'name'        => $socialUser->name,
            'email'       => $socialUser->email,
            'avatar'      => $socialUser->avatar,
            'meta'        => json_encode($socialUser),
        ]);
    }

    /**
     * Returns field name to use at login.
     *
     * @return string
     */
    private function username()
    {
        return config('auth.providers.users.field', 'email');
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
            'name' => $this->validName($socialUser),
            'email' => $socialUser->email,
        ];
        if ($this->username() === 'username') {
            $user['username'] = $socialUser->nickname;
        }
        $userClass = $this->userModel();
        return $userClass::create($user);
    }

    /**
     * Provides always a valid (for database) name.
     *
     * @param $socialUser
     * @return mixed
     */
    private function validName($socialUser)
    {
        if ($socialUser->name) {
            return $socialUser->name;
        }
        //Github users could have no name use login instead
        if ($socialUser->user->login) {
            return $socialUser->login;
        }
        return 'Change your name';
    }
}
