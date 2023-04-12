<?php

namespace Crthiago\LaravelServicesActions\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Crthiago\LaravelServicesActions\ServicesActionsProvider;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServicesActionsProvider::class,
        ];
    }
}