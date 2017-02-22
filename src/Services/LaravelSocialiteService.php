<?php

namespace Acacha\LaravelSocial\Services;

use Acacha\Filesystem\Compiler\StubFileCompiler;
use Acacha\Filesystem\Filesystem;

/**
 * Class LaravelSocialiteService.
 *
 * @package Acacha\LaravelSocial\Services
 */
class LaravelSocialiteService
{
    /**
     * OAuth app.
     *
     * @var
     */
    protected $oauthApp;

    /**
     * Social network name.
     *
     * @var
     */
    protected $socialNetwork;

    /**
     * Compiler for stub file.
     *
     * @var StubFileCompiler
     */
    protected $compiler;

    /**
     * ConfigureLaravelSocialiteService constructor.
     *
     * @param StubFileCompiler $compiler
     * @param Filesystem $filesystem
     */
    public function __construct(StubFileCompiler $compiler, Filesystem $filesystem)
    {
        $this->compiler = $compiler;
        $this->filesystem = $filesystem;
    }

    /**
     * Set OAuth app.
     *
     * @param $oauthApp
     * @return $this
     */
    public function app($oauthApp)
    {
        $this->oauthApp = $oauthApp;
        return $this;
    }

    /**
     * Set social network.
     *
     * @param $socialNetwork
     * @return $this
     */
    public function social($socialNetwork)
    {
        $this->socialNetwork = $socialNetwork;
        return $this;
    }

    /**
     * Configure Laravel Socialite Service.
     */
    public function handle()
    {
        $this->addLaravelSocialiteService();
        $this->addEnvironmentVariables();
    }

    /**
     * Add Laravel Socialite service to config/services.php file.
     */
    protected function addLaravelSocialiteService()
    {
        passthru('llum service ' . $this->getSocialiteServiceStubFile());
    }

    /**
     * Add environment variables to .env file.
     */
    protected function addEnvironmentVariables()
    {
        file_put_contents(
            base_path('.env'),
            $this->getEnvironmentFile(),
            FILE_APPEND | LOCK_EX
        );
    }

    /**
     * Get environment file.
     *
     * @return mixed
     */
    protected function getEnvironmentFile()
    {
        return $this->compiler->compile(
            $this->filesystem->get($this->getSocialiteEnvironmentStubFile()),
            [
                strtoupper($this->socialNetwork) . '_OAUTH_APP_ID' => $this->oauthApp->getId(),
                strtoupper($this->socialNetwork) . '_OAUTH_APP_SECRET' => $this->oauthApp->getSecret(),
                strtoupper($this->socialNetwork) . '_OAUTH_APP_REDIRECT_URL' => $this->oauthApp->getRedirectUrl(),
            ]
        );
    }

    /**
     * Get socialite services stub file.
     *
     * @return string
     */
    private function getSocialiteServiceStubFile()
    {
        return __DIR__ . '/stubs/' . strtolower($this->socialNetwork) . '_service.stub';
    }

    /**
     * Get socialite environment stub file.
     *
     * @return string
     */
    private function getSocialiteEnvironmentStubFile()
    {
        return __DIR__ . '/stubs/' . strtolower($this->socialNetwork) . '_env.stub';
    }
}
