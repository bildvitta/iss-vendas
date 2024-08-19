<?php

namespace Bildvitta\IssVendas\Models\Sale;

use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personalization extends Model
{
    use UsesVendasDB;
    use SoftDeletes;

    protected $table = 'sale_personalizations';

    protected $connection = 'iss-vendas';

    protected $fillable = [
        'uuid',
        'description',
        'file',
        'value',
        'type'
    ];

    protected $guarded = [
        'unit_id',
        'sale_id'
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class, 'sale_id', 'id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
