[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/laravel-polyglot/v/stable)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)
[![License](https://poser.pugx.org/benjamincrozat/laravel-polyglot/license)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/laravel-polyglot/downloads)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)

# Laravel Polyglot

**Not ready for production!**

Switch between multiple languages on your Laravel application, the easy way.

## Requirements

- PHP 7.1+
- Laravel 5.7+

## Installation

```php
composer require benjamincrozat/laravel-polyglot
```

Publish the config file and edit it to your convenience:

```bash
php artisan vendor:publish --provider="BC\Laravel\Polyglot\PolyglotServiceProvider" --tag=polyglot-config
```

Once it's done, register Laravel Polyglot's service provider **before** `RouteServiceProvider` in `config/app.php`:

```php
'providers' => [
    BC\Laravel\Polyglot\PolyglotServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
]
```

Then, go to `app/Providers/RouteServiceProvider.php` and add the `prefix()` method in case you are using the `directories` driver. If you're not, the prefix won't have any effect.

```php
protected function mapWebRoutes()
{
    Route::prefix(polyglot()->prefix())
        ->middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
}
```

Now, take a look at `config/polyglot.php` and change it as you wish.

## Usage

Laravel Polyglot provides views to have something functional and SEO-friendly as quickly as possible.

```php
<!DOCTYPE html>
<html>
    <head>
        @include('polyglot::links')
    </head>
    <body>
        @include('polyglot::switcher')
    </body>
</html>
```

You can publish the view files to customize them:

```bash
php artisan vendor:publish --provider="BC\Laravel\Polyglot\PolyglotServiceProvider" --tag=polyglot-views
```

## ToDo

- [ ] Make [the tests](https://github.com/benjamincrozat/laravel-polyglot-tests) pass on Travis CI

## License

[WTFPL](http://www.wtfpl.net/about/)
