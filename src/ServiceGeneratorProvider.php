<?php

namespace Crthiago\LaravelServiceGenerator;

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
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/service-generator.php' => config_path('service-generator.php'),
            ], 'service-generator-config');
        }
    }
}
