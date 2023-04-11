<?php

namespace Crthiago\LaravelServiceGenerator;

use Crthiago\LaravelServiceGenerator\Commands\MakeServiceCommand;
use Illuminate\Support\ServiceProvider;

class ServiceGeneratorProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/../stubs', 'service-generator');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/service-generator.php' => config_path('service-generator.php'),
            ], 'service-generator-config');

            $this->commands([
                MakeServiceCommand::class,
            ]);
        }
    }
}
