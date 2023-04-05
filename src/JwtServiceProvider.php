<?php

namespace Mideal\Jwt;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class JwtServiceProvider extends ServiceProvider
{

    public function register(): void
    {

        config([
            'auth.guards.jwt' => array_merge([
                'driver' => 'jwt',
                'provider' => config('jwt.provider'),
            ], config('auth.guards.jwt', [])),
        ]);

        if (! app()->configurationIsCached()) {
            $this->mergeConfigFrom(__DIR__.'/../config/jwt.php', 'jwt');
        }

        $this->app->singleton('jwt', function ($app) {
            return new Jwt(config('jwt.password'), config('jwt.alg'));
        });
    }

    public function boot(): void
    {
        if (app()->runningInConsole()) {

            $this->publishes([
                __DIR__.'/../config/jwt.php' => config_path('jwt.php'),
            ], 'jwt-config');

        }

        $this->configureGuard();
    }

    /**
     * Configure the Jwt authentication guard.
     *
     * @return void
     */
    protected function configureGuard()
    {
        Auth::resolved(function ($auth) {

            $auth->extend('jwt', function ($app, $name, array $config) use ($auth) {
                $guard = new JwtGuard($auth->createUserProvider($config['provider'] ?? null), request());
                $this->app->refresh('request', $guard, 'setRequest');

                return $guard;
            });
        });
    }
}
