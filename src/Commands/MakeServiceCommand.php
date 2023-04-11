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
        if (! $fileSystem->exists(app_path('Services/BaseService.php'))) {
            if (! $fileSystem->exists(app_path('Services'))) {
                $fileSystem->makeDirectory(app_path('Services'));
            }
            $fileSystem->put(
                app_path('Services/BaseService.php'),
                view('service-generator::base_service')->render()
            );
        }


        $modelName = str_replace(['Services', 'services', 'Service', 'service'], '', ucfirst($this->argument('model')));
        $this->info('Creating service for ' . $modelName . ' model...');
        if (! class_exists('App\\Models\\' . $modelName)) {
            $this->error('Model not found!');
            return Command::FAILURE;
        }

        if ($fileSystem->exists(app_path('Services/' . $modelName . 'Service.php'))) {
            $this->error('Service already exists!');
            return Command::FAILURE;
        }

        $fileSystem->put(
            app_path('Services/' . $modelName . 'Service.php'),
            view('service-generator::service', ['model' => $modelName])->render()
        );

        return Command::SUCCESS;
    }
}
