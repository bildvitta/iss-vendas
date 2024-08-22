<?php

namespace Bildvitta\IssVendas\Models\Produto;

use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use SoftDeletes;
    use UsesVendasDB;

    protected $connection = 'iss-vendas';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = config('sp-produto.table_prefix') . 'units';
        $this->configDbConnection();
    }

    /**
     * Type of unity.
     */
    public const UNIT_TYPE_LIST = [
        'residential' => 'Residencial',
        'commercial' => 'Comercial',
        'garage' => 'Garagem',
        'storage' => 'Armazém',
    ];

    protected $fillable = [
        'uuid',
        'name',
        'code',
        'unit_type',
        'floor',
        'square_meters',
        'ideal_fraction',
        'fixed_price',
        'table_price',
        'factor',
        'special_needs',
        'observations',
        'ready_to_live_in',
        'notary_registration',
        'property_tax_identification',
        'real_estate_development_id',
        'typology_id',
        'mirror_id',
        'mirror_group_id',
        'external_code',
        'external_subsidiary_code',
        'blueprint_id',
        'garage_type',
        'has_furniture',
        'furniture_value',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    // public function realEstateDevelopment(): BelongsTo
    // {
    //     return $this->belongsTo(RealEstateDevelopment::class);
    // }

    /**
     * Get the typologies for the unit.
     */
    // public function typology()
    // {
    //     return $this->belongsTo(Typology::class);
    // }

    // public function accessories()
    // {
    //     return $this->belongsToMany(Accessory::class, prefixTableName('real_estate_development_accessory_unit'));
    // }

    /**
     * Get the accessories for the unit.
     */
    // public function real_estate_developments_accessories()
    // {
    //     return $this->typology ? $this->typology->accessories() : collect([]);
    // }

    // /**
    //  * Get the blueprints for the unit.
    //  */
    // public function real_estate_developments_blueprints(): BelongsTo
    // {
    //     return $this->belongsTo(Blueprint::class, 'blueprint_id');
    // }

    // /**
    //  * Get the mirrors group for the unit.
    //  */
    // public function mirror_group(): BelongsTo
    // {
    //     return $this->belongsTo(Mirror::class, 'mirror_id');
    // }

    // /**
    //  * Get the mirrors subgroups for the unit.
    //  */
    // public function mirror_subgroup(): BelongsTo
    // {
    //     return $this->belongsTo(MirrorGroup::class, 'mirror_group_id');
    // }

    // public function getTypologyUuidAttribute(): Typology|string|null
    // {
    //     return $this->typology;
    // }

    // public function blueprint()
    // {
    //     return $this->belongsTo(Blueprint::class);
    // }
}
