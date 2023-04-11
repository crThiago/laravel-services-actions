<?php

namespace Crthiago\LaravelServiceGenerator\Tests;

class MakeServiceCommandTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('make:model', ['name' => 'User']);
    }

    /** @test */
    public function it_can_create_a_service()
    {
        $this->artisan('make:service', ['model' => 'User'])
            ->expectsOutput('Service created successfully.')
            ->assertSuccessful();
    }

    /** @test */
    public function it_cant_create_a_service_if_model_doesnt_exist()
    {
        $this->artisan('make:service', ['model' => 'DoesntExist'])
            ->expectsOutput('Model not found!')
            ->assertExitCode(1);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unlink(app_path('Models/User.php'));
        unlink(app_path('Services/UserService.php'));
    }
}