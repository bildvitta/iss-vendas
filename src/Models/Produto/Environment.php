<?php

namespace Bildvitta\IssVendas\Models\Produto;

use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Environment extends Model
{
    use UsesVendasDB;
    use SoftDeletes;

    protected $connection = 'iss-vendas';

    protected $fillable = [
        'uuid',
        'name',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('sp-produto.table_prefix') . 'environments';
    }

    public function personalizations(): BelongsToMany
    {
        return $this->belongsToMany(Personalization::class, prefixTableName('environment_personalization'), 'environment_id', 'personalization_id');
    }
}
