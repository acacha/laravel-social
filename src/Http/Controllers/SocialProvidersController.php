<?php

namespace Acacha\LaravelSocial\Http\Controllers;

use Acacha\LaravelSocial\Contracts\Factory as SocialProviderFactory;
use Acacha\LaravelSocial\Repositories\SocialUserRepository;
use Illuminate\Contracts\Auth\Factory as AuthFactory;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Class SocialProvidersController.
 *
 * @package App\Http\Controllers
 */
class SocialProvidersController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests, RedirectsUsers;

    /**
     * Laravel social provider factory.
     *
     * @var SocialProviderFactory
     */
    protected $socialProvider;

    /**
     * Laravel auth factory.
     *
     * @var \Illuminate\Contracts\Auth\Factory
     */
    protected $auth;

    /**
     * Where to redirect users after login/register.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Social user repository.
     *
     * @var SocialUserRepository
     */
    protected $users;

    /**
     * SocialProvidersController constructor.
     *
     * @param SocialProviderFactory $socialProvider
     * @param AuthFactory $auth
     * @param SocialUserRepository $users
     */
    public function __construct(SocialProviderFactory $socialProvider, AuthFactory $auth, SocialUserRepository $users)
    {
        $this->socialProvider = $socialProvider;
        $this->auth = $auth;
        $this->users = $users;
    }

    /**
     * Redirect to social provider.
     *
     * @param $provider
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return $this->socialProvider->driver($provider)->redirect();
    }

    /**
     * Obtain the user information from social network.
     *
     * @param $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = $this->socialProvider->driver($provider)->user();
        } catch (Exception $e) {
            return Redirect::to('auth/' . $provider);
        }

        $this->auth->login($this->users->provider($provider)->findOrCreateUser($user), true);

        return redirect()->intended($this->redirectPath());
    }
}
