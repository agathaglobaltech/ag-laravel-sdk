<?php

namespace AgathaGlobalTech\AnnuitiesGenius;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AgathaGlobalTech\AnnuitiesGenius\Commands\AnnuitiesGeniusCommand;

class AnnuitiesGeniusServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ag-laravel-sdk')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_ag-laravel-sdk_table')
            ->hasCommand(AnnuitiesGeniusCommand::class);
    }
}
