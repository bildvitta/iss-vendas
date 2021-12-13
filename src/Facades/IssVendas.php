<?php

namespace Bildvitta\IssVendas\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Bildvitta\IssVendas\IssVendas
 */
class IssVendas extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'iss-vendas';
    }
}
