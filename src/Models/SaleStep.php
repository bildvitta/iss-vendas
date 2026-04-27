<?php

namespace Bildvitta\IssVendas\Models;

use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;

class SaleStep extends Model
{
    use UsesVendasDB;

    protected $connection = 'iss-vendas';
}
