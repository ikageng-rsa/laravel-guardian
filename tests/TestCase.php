<?php

namespace Qanna\Guardian\Tests;

use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Qanna\Guardian\GuardianServiceProvider;

class TestCase extends OrchestraTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        $this->loadMigrationsFrom(
            __DIR__.'/../database/migrations/'
        );

    }

    protected function getPackageProviders($app)
    {
        return [
            GuardianServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {

        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);


    }
}