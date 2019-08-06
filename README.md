[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/laravel-polyglot/v/stable)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)
[![License](https://poser.pugx.org/benjamincrozat/laravel-polyglot/license)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/laravel-polyglot/downloads)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)

# Laravel Polyglot

Switch between multiple languages on your Laravel application, the easy way.

## Notes

- The tests suite can be found [here](https://github.com/benjamincrozat/laravel-polyglot-tests)

## Requirements

- PHP 7.1+
- Laravel 5.8+ (it should run fine on previous versions too)

## Installation

```php
composer require benjamincrozat/laravel-polyglot
```

Publish the config file and edit it to your convenience (see the [available drivers](#drivers)):

```bash
php artisan vendor:publish --provider="BC\Laravel\Polyglot\PolyglotServiceProvider" --tag=polyglot-config
```

Once it's done, register Laravel Polyglot's service provider **before** `RouteServiceProvider` in `config/app.php`:

```php
'providers' => [
    ...
    BC\Laravel\Polyglot\PolyglotServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
    ...
]
```

Then, go to `app/Providers/RouteServiceProvider.php` and add the `prefix()` method in case you are using the `directories` driver. If you're not, the prefix won't have any effect.

```php
protected function mapWebRoutes()
{
    Route::prefix(\Polyglot::prefix())
        ->middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
}
```

## Show a language switcher

Laravel Polyglot provides a basic language switcher that you can include in your Blade templates.

```php
@include('polyglot::switcher')
```

## Search Engines Optimizations

https://support.google.com/webmasters/answer/189077

```php
<head>
    @include('polyglot::links')
</head>
```

## Customize the views

```bash
php artisan vendor:publish --provider="BC\Laravel\Polyglot\PolyglotServiceProvider" --tag=polyglot-views
```

## Drivers

### `query_string`

- The user is automatically redirected to his / her language (this behavior can be disabled in the config);
- If the user choose another language, his / her preference is saved in a cookie.

https://foo.com?language={language}

### `directories`

https://foo.com/{language}

### `domains`

https://{language}.foo.com or https://foo.com and https://bar.com

## License

[WTFPL](http://www.wtfpl.net/about/)
