<?php

namespace Crthiago\LaravelServiceGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakeActionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:action {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a new action';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $actionName = str_replace(['Actions', 'actions', 'Action', 'action'], '', ucfirst($this->argument('name')));
        $this->info('Creating action called ' . $actionName . '...');

        $fileSystem = new Filesystem();
        if ($fileSystem->exists(app_path('Actions/' . $actionName . 'Action.php'))) {
            $this->error('Action already exists!');
            return Command::FAILURE;
        }

        if ($fileSystem->missing(app_path('Actions'))) {
            $fileSystem->makeDirectory(app_path('Actions'));
        }

        $fileSystem->put(
            app_path('Actions/' . $actionName . 'Action.php'),
            view('service-generator::action', ['name' => $actionName])->render()
        );

        $this->info('Action created successfully.');
        return Command::SUCCESS;
    }
}
