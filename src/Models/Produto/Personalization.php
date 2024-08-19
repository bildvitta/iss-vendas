<?php

namespace Bildvitta\IssVendas\Models\Produto;

use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personalization extends Model
{
    use UsesVendasDB;
    use SoftDeletes;

    protected $connection = 'iss-vendas';

    protected $fillable = [
        'uuid',
        'name',
        'value',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'value' => 'decimal:2',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('sp-produto.table_prefix') . 'personalizations';
    }

    public function environments(): BelongsToMany
    {
        return $this->belongsToMany(Environment::class, prefixTableName('environment_personalization'), 'personalization_id', 'environment_id');
    }

    public function real_estate_development(): BelongsTo
    {
        return $this->belongsTo(RealEstateDevelopment::class, 'real_estate_development_id', 'id');
    }
}
