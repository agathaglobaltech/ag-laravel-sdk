<?php

namespace AgathaGlobalTech\AnnuitiesGenius;

use AgathaGlobalTech\AnnuitiesGenius\Contracts\AnnuitiesGeniusApi;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
            ->hasConfigFile('annuitiesgenius');
    }

    public function packageRegistered()
    {
        $this->app->when(AnnuitiesGeniusCached::class)
            ->needs('$cacheForHours')
            ->give(config('annuitiesgenius.cache.hours'));

        $this->app->bind(AnnuitiesGenius::class, fn () => new AnnuitiesGenius(
            config('annuitiesgenius.base_url'),
            config('annuitiesgenius.token'),
        ));

        $this->app->bind(
            AnnuitiesGeniusApi::class,
            config('annuitiesgenius.cache.enabled')
                ? AnnuitiesGeniusCached::class
                : AnnuitiesGenius::class
        );
    }
}
