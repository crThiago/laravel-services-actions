<?php

namespace Crthiago\LaravelServiceGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeServiceCommand extends Command
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
    public function handle()
    {
        $fileSystem = new Filesystem();
        $servicePath = config('service-generator.path.service');
        $serviceNamespace = config('service-generator.namespace.service');
        if (! $fileSystem->exists($servicePath . '/BaseService.php')) {
            if (! $fileSystem->exists($servicePath)) {
                $fileSystem->makeDirectory($servicePath , 0755, true);
            }
            $fileSystem->put(
                $servicePath . '/BaseService.php',
                view('service-generator::base_service', ['namespace' => $serviceNamespace])->render()
            );
        }


        $modelName = str_replace(['Services', 'services', 'Service', 'service'], '', ucfirst($this->argument('model')));
        $this->info('Creating service for ' . $modelName . ' model...');
        $modelPath = config('service-generator.path.model');
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
                'service-generator::service',
                [
                    'service' => [
                        'namespace' => $serviceNamespace,
                        'model' => $modelName,
                        'model_namespace' => config('service-generator.namespace.model'),
                    ]
                ]
            )->render()
        );

        $this->info('Service created successfully.');
        return Command::SUCCESS;
    }
}
