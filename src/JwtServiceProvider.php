<?php

namespace Mideal\Jwt;

use Illuminate\Support\ServiceProvider;

class JwtServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->singleton('jwt', fn ($app) => new Jwt(config('jwt.'.array_reverse(explode('.', (string) $_SERVER['HTTP_HOST']))[1].'_password'), config('jwt.alg')));
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
