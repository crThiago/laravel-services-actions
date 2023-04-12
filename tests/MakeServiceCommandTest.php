<?php

namespace Crthiago\LaravelServicesActions\Tests;

class MakeServiceCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('make:model', ['name' => 'User']);
    }

    protected function defineEnvironment($app)
    {
        $app['config']->set('services-actions.path.model', app_path('Models'));
        $app['config']->set('services-actions.namespace.model', 'App\Models');
    }

    protected function defaultConfig($app)
    {
        $app['config']->set('services-actions.path.service', app_path('Services'));
        $app['config']->set('services-actions.namespace.service', 'App\Services');
    }

    protected function customConfig($app)
    {
        $app['config']->set('services-actions.path.service', app_path('Parent/Services'));
        $app['config']->set('services-actions.namespace.service', 'App\Parent\Services');
    }

    /**
     * @test
     * @define-env defaultConfig
     */
    public function it_can_create_a_service()
    {
        $this->artisan('make:service', ['model' => 'User'])
            ->expectsOutput('Service created successfully.')
            ->assertSuccessful();

        $this->assertFileExists(app_path('Services/UserService.php'));

        unlink(app_path('Services/UserService.php'));
    }

    /**
     * @test
     * @define-env customConfig
     */
    public function it_can_create_a_service_with_custom_config()
    {
        $this->artisan('make:service', ['model' => 'User'])
            ->expectsOutput('Service created successfully.')
            ->assertSuccessful();

        $this->assertFileExists(app_path('Parent/Services/UserService.php'));
        unlink(app_path('Parent/Services/UserService.php'));
    }

    /**
     * @test
     * @define-env defaultConfig
     */
    public function it_cant_create_a_service_if_model_doesnt_exist()
    {
        $this->artisan('make:service', ['model' => 'DoesntExist'])
            ->expectsOutput('Model not found!')
            ->assertExitCode(1);
    }

    /**
     * @test
     * @define-env defaultConfig
     */
    public function it_cant_create_a_service_if_service_already_exists()
    {
        $this->artisan('make:service', ['model' => 'User']);

        $this->artisan('make:service', ['model' => 'User'])
            ->expectsOutput('Service already exists!')
            ->assertExitCode(1);

        unlink(app_path('Services/UserService.php'));
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unlink(app_path('Models/User.php'));
    }
}