<?php

namespace Acacha\LaravelSocial\Models;

use Acacha\LaravelSocial\Traits\UserModel;
use Illuminate\Database\Eloquent\Model;

use BadMethodCallException;

/**
 * Class SocialUser.
 *
 * @package Acacha\LaravelSocial\Models
 */
class SocialUser extends Model
{
    use UserModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'social_id', 'social_type','nickname','name','email','avatar','meta'
    ];

    /**
     * Get the user that owns the social user.
     */
    public function user()
    {
        return $this->belongsTo($this->userModel());
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        if (parent::__get($key) == null) {
            return $this->getAttributeFromMeta($key);
        }
        return parent::__get($key);
    }

    /**
     * Get an attribute from the meta field.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttributeFromMeta($key)
    {
        if (! $key) {
            return;
        }

        // Here we will determine if the model base class itself contains this given key
        // since we do not want to treat any of those methods are relationships since
        // they are all intended as helper methods and none of these are relations.
        if (method_exists(self::class, $key)) {
            return;
        }

        $meta = json_decode($this->getAttribute('meta'));
        if (isset($meta->$key)) {
            return $meta->$key;
        }

        $user = $meta->user;
        if (isset($user->$key)) {
            return $user->$key;
        }
    }
}
