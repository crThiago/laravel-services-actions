<?php

namespace Crthiago\LaravelServicesActions\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

final class MakeServiceCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {model}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new service';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $fileSystem = new Filesystem();
        $servicePath = config('services-actions.path.service');
        $serviceNamespace = config('services-actions.namespace.service');
        if (! $fileSystem->exists($servicePath . '/BaseService.php')) {
            if (! $fileSystem->exists($servicePath)) {
                $fileSystem->makeDirectory($servicePath, 0755, true);
            }
            $fileSystem->put(
                $servicePath . '/BaseService.php',
                view('services-actions-views::base_service', ['namespace' => $serviceNamespace])->render()
            );
        }

        $modelName = str_replace(['Services', 'services', 'Service', 'service'], '', ucfirst($this->argument('model')));
        $this->info('Creating service for ' . $modelName . ' model...');
        $modelPath = config('services-actions.path.model');
        if ($fileSystem->missing($modelPath . '/' . $modelName . '.php')) {
            $this->error('Model not found!');
            return Command::FAILURE;
        }

        if ($fileSystem->exists($servicePath . '/' . $modelName . 'Service.php')) {
            $this->error('Service already exists!');
            return Command::FAILURE;
        }

        $fileSystem->put(
            $servicePath . '/' . $modelName . 'Service.php',
            view(
                'services-actions-views::service',
                [
                    'service' => [
                        'namespace' => $serviceNamespace,
                        'model' => $modelName,
                        'model_namespace' => config('services-actions.namespace.model'),
                    ],
                ]
            )->render()
        );

        $this->info('Service created successfully.');
        return Command::SUCCESS;
    }
}
