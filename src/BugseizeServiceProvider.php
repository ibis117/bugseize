<?php

namespace Ibis117\Bugseize;


use Ibis117\Bugseize\Http\Client;
use Ibis117\Bugseize\Logger\BugSeizeHandler;
use Illuminate\Log\LogManager;
use Illuminate\Support\ServiceProvider;
use Monolog\Logger;

class BugseizeServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ibis117');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'ibis117');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

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
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/bugseize.php', 'bugseize');

        // Register the service the package provides.
        $this->app->singleton('bugseize', function ($app) {
            $client = new Client('', '');
            return new Bugseize($client);
        });

        if (($logManager = $this->app->make('log')) instanceof LogManager) {
            $logManager->extend('bugseize', function ($app, array $config) {
                $handler = new BugSeizeHandler($app['bugseize']);
                return new Logger('bugseize', [$handler]);
            });
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['bugseize'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/bugseize.php' => config_path('bugseize.php'),
        ], 'bugseize.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/ibis117'),
        ], 'bugseize.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/ibis117'),
        ], 'bugseize.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/ibis117'),
        ], 'bugseize.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
