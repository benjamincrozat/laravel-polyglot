[![Build Status](https://travis-ci.org/benjamincrozat/laravel-polyglot.svg?branch=master)](https://travis-ci.org/benjamincrozat/laravel-polyglot)
[![Latest Stable Version](https://poser.pugx.org/benjamincrozat/laravel-polyglot/v/stable)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)
[![License](https://poser.pugx.org/benjamincrozat/laravel-polyglot/license)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)
[![Total Downloads](https://poser.pugx.org/benjamincrozat/laravel-polyglot/downloads)](https://packagist.org/packages/benjamincrozat/laravel-polyglot)

# Laravel Polyglot

Switch between multiple languages on your Laravel application, the easy way.

## Requirements

- PHP 7.1+
- Laravel 5.5+

## Notes

This package assume that you want every language to behave like a separate website. There is no guessing, Laravel Polyglot won't do automatic switch to the user's language. From an SEO point of view, that's the recommanded way to handle multiple languages (see [apple.com](https://www.apple.com), [amazon.com](https://www.amazon.com), [google.com](https://www.google.com), etc). More on the topic here: https://support.google.com/webmasters/answer/182192

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

This package should work seamlessly once it's correctly configured (assuming you have a "proper" Laravel project). The only thing you have to think about is to make a language menu. Here's how it can be done:

```php
<ul>
    @foreach (config('polyglot.languages') as $language)
        <li>
            <a href="{{ polyglot()->switchTo($language) }}">
                {{ $language }}
            </a>
        </li>
    @endforeach
</ul>
```

The `switchTo()` method switches the *current URL* to another language. You won"t have to go back to the home page.

Note that Laravel Polyglot can be accessed in various way:

```php
app('polyglot')->switchTo('fr');

Polyglot::switchTo('fr');

polyglot()->switchTo('fr');
```

## License

[WTFPL](http://www.wtfpl.net/about/)
