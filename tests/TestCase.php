<?php

namespace AgathaGlobalTech\AnnuitiesGenius\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Orchestra\Testbench\TestCase as Orchestra;
use AgathaGlobalTech\AnnuitiesGenius\AnnuitiesGeniusServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'AgathaGlobalTech\\AnnuitiesGenius\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            AnnuitiesGeniusServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_ag-laravel-sdk_table.php.stub';
        $migration->up();
        */
    }
}
