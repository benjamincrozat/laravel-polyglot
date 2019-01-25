[![Build Status](https://travis-ci.org/benjamincrozat/laravel-polyglot-tests.svg?branch=master)](https://travis-ci.org/benjamincrozat/laravel-polyglot-tests)
[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/laravel-polyglot/v/stable)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)
[![License](https://poser.pugx.org/benjamincrozat/laravel-polyglot/license)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/laravel-polyglot/downloads)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)

# Laravel Polyglot

Switch between multiple languages on your Laravel application, the easy way.

## Requirements

- PHP 7.1+
- Laravel 5.5+

## Notes

**The tests are in a [separate repository](https://github.com/benjamincrozat/laravel-polyglot-tests).**

This package assume that you want every language to behave like a separate website. There is no guessing, Laravel Polyglot won't do automatic switch to the user's language. From an SEO point of view, that's the recommanded way to handle multiple languages, because Google and others will be able to visit and index every language (see [amazon.com](https://www.amazon.com), [apple.com](https://www.apple.com), [google.com](https://www.google.com), etc). More on the topic here: https://support.google.com/webmasters/answer/182192

## Installation

```php
composer require benjamincrozat/laravel-polyglot
```

Once it's done, register Laravel Polyglot **before** `RouteServiceProvider` in `config/app.php`:

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

Once you configured Laravel Polyglot, there are views that are here to help on the SEO and the language switcher:

```php
<!DOCTYPE html>
<html>
    <head>
        @include('polyglot::meta')
    </head>
    <body>
        @include('polyglot::switcher')
    </body>
</html>
```

Obviously, you are free to not use them and make your own!

## License

[WTFPL](http://www.wtfpl.net/about/)
