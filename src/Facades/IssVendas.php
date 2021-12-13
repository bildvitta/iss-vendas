<?php

namespace iss-vendas\IssVendas\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \iss-vendas\IssVendas\IssVendas
 */
class IssVendas extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'iss-vendas';
    }
}
