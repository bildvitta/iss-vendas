<?php

namespace Bildvitta\IssVendas\Models\Crm;

use Bildvitta\IssVendas\Models\Sale;
use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use UsesVendasDB;
    use SoftDeletes;

    protected $connection = 'iss-vendas';

    protected $table = 'crm_customers';

    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class, 'crm_customer_id', 'id');
    }
}
