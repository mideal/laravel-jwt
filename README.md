## Introduction

Laravel Jwt provides a authentication system with jwt for SPAs and API.

## Installation

You may install Laravel Jwt via the Composer package manager:
```
composer require mideal/laravel-jwt
```

Next, you should publish the Jwt configuration files using the vendor:publish Artisan command. The jwt configuration file will be placed in your application's config directory:
```php
php artisan vendor:publish --provider="Mideal\Jwt\JwtServiceProvider"
```

## Protecting Routes


```php
use Illuminate\Http\Request;

Route::middleware('auth:jwt')->get('/user', function (Request $request) {
    return $request->user();
});
```