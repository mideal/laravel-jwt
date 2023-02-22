## Introduction

Laravel Jwt provides a authentication system with jwt for SPAs and API.

## Installation

You may install Laravel Jwt via the Composer package manager:
```
composer require mideal/laravel-jwt
```

Next, you should publish the Sanctum configuration and migration files using the vendor:publish Artisan command. The sanctum configuration file will be placed in your application's config directory:
```
php artisan vendor:publish --provider="Mideal\Jwt\JwtServiceProvider"
```