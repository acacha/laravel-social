# laravel-social

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads](https://poser.pugx.org/acacha/laravel-social/downloads.png)](https://packagist.org/packages/acacha/laravel-social)
[![Monthly Downloads](https://poser.pugx.org/acacha/laravel-social/d/monthly)](https://packagist.org/packages/acacha/laravel-social)
[![Daily Downloads](https://poser.pugx.org/acacha/laravel-social/d/daily)](https://packagist.org/packages/acacha/laravel-social)
[![Latest Stable Version](https://poser.pugx.org/acacha/laravel-social/v/stable.png)](https://packagist.org/packages/acacha/laravel-social)
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Quality Score][ico-code-quality]][link-code-quality]
[![StyleCI](https://styleci.io/repos/82290394/shield)](https://styleci.io/repos/82290394)

A Laravel 5 package for **OAuth Social Login/Register** implementation using [Laravel socialite](https://github.com/laravel/socialite) and (optionally) [AdminLTE Laravel package](https://github.com/acacha/adminlte-laravel).

## Installation

## Using adminlte laravel (recommended option)

Install [AdminLTE Laravel package](https://github.com/acacha/adminlte-laravel):

```bash
composer global require "acacha/adminlte-laravel-installer=~3.0"
laravel new awesome
cd awesome
adminlte-laravel install
adminlte-laravel social
```

Then optionally you can boostrap you project in your favourite browser using:
 
```bash
llum boot
```

## Using composer 

Use Composer, in you Laravel project:

``` bash
$ composer global require "acacha/llum=~1.0"
$ composer require acacha/laravel-social
```

Add service provider to providers array in your **config/app.php** file:

```php
Acacha\LaravelSocial\Providers\LaravelSocialServiceProvider::class
```

And run command:

```bash
php artisan make:social
```

To configure social network providers. 

Finally modify your app views to add links to Social Login using link:
 
```
http://yourappurl.com/auth/{socialnetwork}
```

Examples:

```
http://yourappurl.com/auth/github
http://yourappurl.com/auth/facebook
http://yourappurl.com/auth/google
http://yourappurl.com/auth/twitter
http://yourappurl.com/auth/linkedin
```

I recommend you to use [AdminLTE Laravel Package](https://github.com/acacha/adminlte-laravel) for a full working Auth scaffolding with Adminlte bootstrap template. See previous section. 

You can also use Laravel default Auth scaffolding running command:
 
```bash
php artisan make:auth
```

And manually add button/links to social Login/Register.

### Use llum

You can also use `llum package` command to install this package (see [acacha/llum](https://github.com/acacha/llum)):

```bash
llum package laravel-social
```

## Usage

You can configure Social Providers with command:

```bash
php artisan acacha:social
 Which social network you wish to configure? [Github]:
  [0] Github
  [1] Facebook
  [2] Google
  [3] Twitter
  [4] Linkedin
 > 0
  
  Configuring social network Github...
  Please register a new OAuth app for Github. Go to URL https://github.com/settings/applications/new
  Then ask the following questions:
  
   OAuth client id?:
   > 3a1fg6ac5437f9f4cebd
   
   OAuth client secret?:
   > 5919185e3fb7024e5b10cedce5cce408893224d         
   
   OAuth client redirect URL? [http://localhost:8080/auth/github/callback]:
   > 
   
  File /home/sergi/Code/socialAdminLTEtest/config/app.php already supports llum.
  Llum is already installed. Skipping...
  File /home/sergi/Code/socialAdminLTEtest/config/services.php updated.
  Github added to config/services.php file
  
   Do you wish to configure other social networks? (yes/no) [yes]: 
```

This wizard will adapt your `.env` and `config/services.php` files to add your social networks OAuth data.

At this moment command ```php artisan acacha:social``` will not check if you have already configured your social network 
so be carefull when executing this command in already configured projects (no errors will be thrown but you will have 
repeated data in your config files). 

## Requirements

Please install [AdminLTE Laravel](https://github.com/acacha/adminlte-laravel):

```bash
composer global require "acacha/adminlte-laravel-installer=~3.0"
```

You can also use this package without adminlte but hen you have to install [acacha/llum](https://github.com/acacha/llum) before using this package:

```bash
composer global require "acacha/llum=~1.0"
```

This package also requires (all installed using composer):

- [Laravel framework](https://github.com/laravel/frameworks)
- [Laravel socialite](https://github.com/laravel/socialite)
- [Doctrine dbal](https://github.com/doctrine/dbal)
- [Acacha filesystem](https://github.com/acacha/filesystem)

See also related projects:

- [AdminLTE Laravel](https://github.com/acacha/adminlte-laravel)
- [Acacha llum](https://github.com/acacha/llum)
- [AdminLTE](https://github.com/almasaeed2010/AdminLTE)

## Social networks

Laravel social package support by default the following social networks:

- Github
- Facebook
- Google
- Twitter
- Linkedin

Laravel social use [Illuminate\Support\Manager](https://laravel.com/api/5.4/Illuminate/Support/Manager.html) so you can create your own driver and register the driver in LaravelSocialServiceProvider.

Please, if you create a new driver feel free to create a Pull Request.

You can enable/disable social providers easily. See following section.

### Enable/disable social providers

At class `LaravelSocialServiceProvider` you can modify `$enabled` field to change enabled social providers.
Also remember to changes your views to add/remove action/links to social auth.

Also you have to change static variable `$socialNetworks` in file ConfigureSocialServicesManager to add your extra social providers.

### Github ###

The cli wizard will propose you to go to page:

https://github.com/settings/applications/new

to register new OAuth Application.

### Facebook ###

The cli wizard will propose you to go to page:

https://developers.facebook.com/apps/

to register new OAuth Application

### Google ###

The cli wizard will propose you to go to page:

https://console.developers.google.com

to register new OAuth Application. Please remember to active Google+ API!. 

More info at https://developers.google.com/identity/sign-in/web/devconsole-project .

### Twitter ###

The cli wizard will propose you to go to page:

https://apps.twitter.com/app/new

to register new OAuth Application. Retrieve your api keys at tab `Keys and Access Tokens` 
and remember to check `Request email addresses from users` checkbox active in `Permissions` tab.

### Linkedin ###

The cli wizard will propose you to go to page:

https://www.linkedin.com/secure/developer

to register new OAuth Application.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

In your Laravel project execute:

``` bash
$ phpunit tests/AcachaLaravelSocial.php
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email sergiturbadenas@gmail.com instead of using the issue tracker.

## Credits

- [Sergi Tur Badenas][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/acacha/laravel-social.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/acacha/laravel-social/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/acacha/laravel-social.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/acacha/laravel-social.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/acacha/laravel-social.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/acacha/laravel-social
[link-travis]: https://travis-ci.org/acacha/laravel-social
[link-scrutinizer]: https://scrutinizer-ci.com/g/acacha/laravel-social/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/acacha/laravel-social
[link-downloads]: https://packagist.org/packages/acacha/laravel-social
[link-author]: https://github.com/acacha
[link-contributors]: ../../contributors
