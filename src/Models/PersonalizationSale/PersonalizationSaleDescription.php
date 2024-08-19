<?php

namespace Bildvitta\IssVendas\Models\PersonalizationSale;

use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalizationSaleDescription extends Model
{
    use UsesVendasDB;
    use SoftDeletes;

    protected $table = 'personalization_sale_descriptions';
    protected $connection = 'iss-vendas';

    protected $fillable = [
        'uuid',
        'description',
    ];

    public function personalization_sale(): BelongsTo
    {
        return $this->belongsTo(PersonalizationSale::class, 'personalization_sale_id', 'id');
    }

}
