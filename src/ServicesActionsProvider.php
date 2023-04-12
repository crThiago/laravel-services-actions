<?php

namespace Crthiago\LaravelServicesActions;

use Crthiago\LaravelServicesActions\Commands\MakeActionCommand;
use Crthiago\LaravelServicesActions\Commands\MakeServiceCommand;
use Illuminate\Support\ServiceProvider;

class ServicesActionsProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../stubs', 'services-actions-views');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/services-actions.php' => config_path('services-actions.php'),
            ], 'services-actions-config');

            $this->commands([
                MakeServiceCommand::class,
                MakeActionCommand::class,
            ]);
        }
    }
}
