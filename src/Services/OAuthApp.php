<?php

namespace Acacha\LaravelSocial\Services;

/**
 * Class OAuthApp.
 *
 * @package Acacha\LaravelSocial\Services
 */
class OAuthApp
{
    /**
     * OAuth app id.
     * @var
     */
    protected $id;

    /**
     * OAuth app secret.
     * @var
     */
    protected $secret;

    /**
     * OAuth app redirect url.
     * @var
     */
    protected $redirect_url;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getSecret()
    {
        return $this->secret;
    }

    /**
     * @param mixed $secret
     */
    public function setSecret($secret)
    {
        $this->secret = $secret;
    }

    /**
     * @return mixed
     */
    public function getRedirectUrl()
    {
        return $this->redirect_url;
    }

    /**
     * @param mixed $redirect_url
     */
    public function setRedirectUrl($redirect_url)
    {
        $this->redirect_url = $redirect_url;
    }
}
