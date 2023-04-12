<?php

namespace Crthiago\LaravelServicesActions\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

final class MakeActionCommand extends Command
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
    public function handle(): int
    {
        $actionName = str_replace(['Actions', 'actions', 'Action', 'action'], '', ucfirst($this->argument('name')));
        $this->info('Creating action called ' . $actionName . '...');

        $fileSystem = new Filesystem();
        $actionPath = config('services-actions.path.action');
        if ($fileSystem->exists($actionPath . '/' . $actionName . 'Action.php')) {
            $this->error('Action already exists!');
            return Command::FAILURE;
        }

        if ($fileSystem->missing($actionPath)) {
            $fileSystem->makeDirectory($actionPath, 0755, true);
        }

        $fileSystem->put(
            $actionPath . '/' . $actionName . 'Action.php',
            view(
                'services-actions-views::action',
                [
                    'action' => [
                        'namespace' => config('services-actions.namespace.action'),
                        'name' => $actionName,
                        'method' => config('services-actions.action_method'),
                    ],
                ]
            )->render()
        );

        $this->info('Action created successfully.');
        return Command::SUCCESS;
    }
}
