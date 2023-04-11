<?php

namespace Crthiago\LaravelServiceGenerator\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Crthiago\LaravelServiceGenerator\ServiceGeneratorProvider;

class TestCase extends OrchestraTestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceGeneratorProvider::class,
        ];
    }
}