<?php
/*
 * Same configuration as Laravel 5.2 make auth:
 * See https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/routes.stub
 * but take into account we have to add 'web' middleware group here because Laravel by defaults add this middleware in
 * RouteServiceProvider
 */
Route::group(['middleware' => 'web'], function () {
    Route::get('auth/{socialProvider}', 'SocialProvidersController@redirectToProvider');
    Route::get('auth/{socialProvider}/callback', 'SocialProvidersController@handleProviderCallback');
    Route::get('auth/register/{socialProvider}', 'SocialProvidersController@redirectToProvider');
    Route::get('auth/register/{socialProvider}/callback', 'SocialProvidersController@handleProviderCallback');
});
