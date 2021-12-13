<?php

namespace Bildvitta\IssVendas;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Bildvitta\IssVendas\Commands\IssVendasCommand;

class IssVendasServiceProvider extends PackageServiceProvider
{
    /**
     * @param  Package  $package
     */
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('iss-vendas')->hasConfigFile();
    }
}
