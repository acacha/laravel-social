<?php

namespace Acacha\LaravelSocial\Models;

use Acacha\LaravelSocial\Traits\UserModel;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SocialUser.
 *
 * @package Acacha\LaravelSocial\Models
 */
class SocialUser extends Model
{
    use UserModel;

    /**
     * Get the user that owns the social user.
     */
    public function user()
    {
        return $this->belongsTo($this->userModel());
    }
}
