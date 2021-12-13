<?php

namespace iss-vendas\IssVendas;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use iss-vendas\IssVendas\Commands\IssVendasCommand;

class IssVendasServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('iss-vendas')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_iss-vendas_table')
            ->hasCommand(IssVendasCommand::class);
    }
}
