<?php

namespace Crthiago\LaravelServiceGenerator\Tests;

class MakeActionCommandTest extends TestCase
{
    protected function defaultConfig($app)
    {
        $app['config']->set('service-generator.path.action', app_path('Actions'));
        $app['config']->set('service-generator.namespace.action', 'App\Actions');
        $app['config']->set('service-generator.action_method', 'handle');
    }

    protected function customConfig($app)
    {
        $app['config']->set('service-generator.path.action', app_path('Parent/Actions'));
        $app['config']->set('service-generator.namespace.action', 'App\Parent\Actions');
        $app['config']->set('service-generator.action_method', 'execute');
    }

    /**
     * @test
     * @define-env defaultConfig
     */
    public function it_can_create_a_action()
    {
        $this->artisan('make:action', ['name' => 'UpdateUser'])->expectsOutput(
                'Action created successfully.'
            )->assertSuccessful();

        $this->assertFileExists(app_path('Actions/UpdateUserAction.php'));

        unlink(app_path('Actions/UpdateUserAction.php'));
    }

    /**
     * @test
     * @define-env customConfig
     */
    public function it_can_create_a_action_with_custom_config()
    {
        $this->artisan('make:action', ['name' => 'UpdateUser'])->expectsOutput(
                'Action created successfully.'
            )->assertSuccessful();

        $this->assertFileExists(app_path('Parent/Actions/UpdateUserAction.php'));

        unlink(app_path('Parent/Actions/UpdateUserAction.php'));
    }
}