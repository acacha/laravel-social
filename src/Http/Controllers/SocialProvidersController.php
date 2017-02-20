<?php

namespace Acacha\LaravelSocial\Http\Controllers;

use Acacha\LaravelSocial\Contracts\Factory as SocialProviderFactory;
use Illuminate\Http\Request;
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
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Laravel social provider factory.
     *
     * @var SocialProviderFactory
     */
    protected $socialProvider;

    /**
     * SocialProvidersController constructor.
     *
     * @param $socialProvider
     */
    public function __construct(SocialProviderFactory $socialProvider)
    {
        $this->socialProvider = $socialProvider;
    }

    /**
     * Redirect to social provider.
     *
     * @param $provider
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider($provider, Request $request)
    {
        if ($request->is('auth/register/*')) {
            $request->session()->flash('origin', 'register');
        };
        return $this->socialProvider->driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider, Request $request)
    {
        if ($request->session()->get('origin', 'login') === 'register') {
            $this->handleRegister();
        }

        $this->handleLogin($provider);
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $socialUser
     * @return User
     */
    private function findOrCreateUser($socialUser)
    {
        if ($authUser = User::where('social_id', $socialUser->id)->first()) {
            return $authUser;
        }

        return User::create([
            'name' => $socialUser->name,
            'email' => $socialUser->email,
            'github_id' => $socialUser->id,
            'avatar' => $socialUser->avatar
        ]);
    }

    protected function handleRegister()
    {
        dump('todo handle register');
    }

    protected function handleLogin($provider)
    {
        dd($this->socialProvider->driver($provider)->user());
        //        $this->socialProvider->driver($provider)->handleProviderCallback();

        try {
            //TODO
            $user = Socialite::driver('github')->user();
        } catch (Exception $e) {
            return Redirect::to('auth/github');
        }

        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return Redirect::to('home');
    }
}
