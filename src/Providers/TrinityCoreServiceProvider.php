<?php

namespace ThibaudDT\LaravelTrinityCoreAuth\Providers;

use Auth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

use Illuminate\Contracts\Auth\Guard as IlluminateGuard;
use Illuminate\Contracts\Hashing\Hasher as IlluminateHasher;

use ThibaudDT\LaravelTrinityCoreAuth\Guard\TrinityCoreGuard;
use ThibaudDT\LaravelTrinityCoreAuth\Hashing\TrinityCoreHasher;

use ThibaudDT\LaravelTrinityCoreAuth\Models\Auth\Account;
use ThibaudDT\LaravelTrinityCoreAuth\TrinityCore;

/**
 * Class TrinityCoreServiceProvider
 *
 * @category Provider
 * @package  ThibaudDT\LaravelTrinityCoreAuth\Providers
 * @author   Thibaud DELOBELLE TOUSSAINT <thibaud@d-t.fr>
 * @license  GNU
 * @link     https://github.com/Thibaud-DT/laravel-trinitycore
 */
class TrinityCoreServiceProvider extends ServiceProvider
{


    /**
     * Illuminate Filesystem
     *
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $filesystem;

    public function __construct(Application $application)
    {
        parent::__construct($application);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');

        $this->registerAuthProvider();

        $this->publishConfigs();
    }


    /**
     * Publishes the config stub(s)
     *
     * @return void
     */
    protected function publishConfigs()
    {
        $this->publishes([
            __DIR__ . '/../../config/config.php' => config_path('trinitycore.php'),
        ]);
    }

    /**
     * Registers the Auth provider for authentication against TrinityCore Account(s).
     * if desired, this can be used as default by changing the value(s) in config auth.php
     *
     * @return void
     */
    protected function registerAuthProvider()
    {
        Auth::provider('trinitycore', function (Application $app) {
            return new AccountProvider($app->make(IlluminateHasher::class), $app->make(Account::class));
        });
    }

    /**
     * Register bindings in the container.
     *
     *
     * @return void
     */
    public function register()
    {
        // Bind and tag our Auth components.
        $this->app->bind(IlluminateHasher::class, TrinityCoreHasher::class);
        $this->app->tag(IlluminateHasher::class, 'TrinityCore');

        $this->app->bind(IlluminateGuard::class, TrinityCoreGuard::class);
        $this->app->tag(IlluminateGuard::class, 'TrinityCore');

        // $this->app->bind(IlluminateGuard::class, TrinityCoreGuard::class);
        $this->app->bind('trinitycore', function(){
            return new TrinityCore();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     *
     * @return array
     */
    public function provides()
    {
        return [
            TrinityCoreHasher::class,
            TrinityCoreGuard::class
        ];
    }
}
