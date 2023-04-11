<?php

namespace Crthiago\LaravelServiceGenerator\Tests;

class MakeActionCommandTest extends TestCase
{
    /** @test */
    public function it_can_create_a_action()
    {
        $this->artisan('make:action', ['name' => 'UpdateUser'])
            ->expectsOutput('Action created successfully.')
            ->assertSuccessful();
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        unlink(app_path('Actions/UpdateUserAction.php'));
    }
}