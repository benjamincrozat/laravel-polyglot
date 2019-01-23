[![Build Status](https://travis-ci.org/benjamincrozat/laravel-polyglot.svg?branch=master)](https://travis-ci.org/benjamincrozat/laravel-polyglot)
[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/laravel-polyglot/v/stable)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)
[![License](https://poser.pugx.org/benjamincrozat/laravel-polyglot/license)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/laravel-polyglot/downloads)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)

# Laravel Polyglot

Multiple languages support on your Laravel application, made easy.

## Requirements

- PHP 7.1+
- Laravel 5.5+

## Installation

```php
composer require benjamincrozat/laravel-polyglot
```

## Usage

Register Laravel Polyglot **before** `RouteServiceProvider` in `config/app.php`:

```php
'providers' => [
    BC\Laravel\Polyglot\PolyglotServiceProvider::class,
    App\Providers\RouteServiceProvider::class,
]
```

Then, go to `app/Providers/RouteServiceProvider.php` and the `prefix()` method in case you are using the `directories`driver. If you don't, the prefix will be emptu and won't have any effect.

```php
protected function mapWebRoutes()
{
    Route::prefix(polyglot()->prefix())
        ->middleware('web')
        ->namespace($this->namespace)
        ->group(base_path('routes/web.php'));
}
```

Please note that Polyglot is a good Laravel citizen and can be accessed from the container in any way you want:

```php
app('polyglot')->urlToLanguage('fr');

Polyglot::urlToLanguage('fr');

polyglot()->urlToLanguage('fr');
```

Now, take a look at `config/polyglot.php` and change it as you wish.

## License

[WTFPL](http://www.wtfpl.net/about/)
