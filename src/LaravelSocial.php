<?php

namespace Acacha\LaravelSocial;

/**
 * Class LaravelSocial.
 */
class LaravelSocial
{
    /**
     * Home controller copy path.
     *
     * @return array
     */
    public function homeController()
    {
        return [
            LARAVELSOCIAL_PATH.'/src/stubs/HomeController.stub' => app_path('Http/Controllers/HomeController.php'),
        ];
    }

    /**
     * Auth register controller copy path.
     *
     * @return array
     */
    public function registerController()
    {
        return [
            LARAVELSOCIAL_PATH.'/src/stubs/RegisterController.stub' =>
                app_path('Http/Controllers/Auth/RegisterController.php'),
        ];
    }
}
