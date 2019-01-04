<?php

namespace Vaggelis\LaravelCasService;

use Illuminate\Support\ServiceProvider;
use Vaggelis\LaravelCasService\Cas\CasInstance;
use Vaggelis\LaravelCasService\Contracts\ICasInstance;
use Vaggelis\LaravelCasService\Contracts\ICasRedirector;
use Vaggelis\LaravelCasService\Contracts\ILaravelCasService;
use Vaggelis\LaravelCasService\Services\CasRedirector;

class LaravelCasServiceServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'vaggelis');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'vaggelis');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
//         $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravelcasservice.php', 'laravelcasservice');

        // Register the service the package provides.
        $this->app->singleton(ICasRedirector::class, CasRedirector::class);
        $this->app->singleton(ICasInstance::class, function ($app) {
            return new CasInstance($app->make(ICasRedirector::class));
        });
        $this->app->singleton(ILaravelCasService::class, function($app) {
            return new LaravelCasService($app->make(ICasInstance::class));
        });

        //$this->app->register(CasEventServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravelcasservice'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravelcasservice.php' => config_path('laravelcasservice.php'),
        ], 'laravelcasservice.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/vaggelis'),
        ], 'laravelcasservice.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/vaggelis'),
        ], 'laravelcasservice.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/vaggelis'),
        ], 'laravelcasservice.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
