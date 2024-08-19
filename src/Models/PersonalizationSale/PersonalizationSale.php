<?php

namespace Bildvitta\IssVendas\Models\PersonalizationSale;

use Bildvitta\IssVendas\Models\Produto\Personalization;
use Bildvitta\IssVendas\Models\Sale;
use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalizationSale extends Model
{
    use UsesVendasDB;
    use SoftDeletes;

    protected $table = 'personalization_sales';

    protected $connection = 'iss-vendas';

    public const STATUS = [
        'awaiting_sending_for_signature' => 'Awaiting sending for signature',
        'awaiting_signature' => 'Awaiting signature',
        'not_integrated' => 'Not integrated',
        'finished' => 'Finished',
        'canceled' => 'Canceled',
        'awaiting_integration' => 'Awaiting integration',
        'error_sending_for_signature' => 'Error sending for signature',
        'integration_error' => 'Integration error',
    ];

    public const TYPE = [
        'initial_contract' => 'Initial Contract',
    ];

    public const LEGAL_DOCUMENT_STATUS = [
        'not_sent' => 'Contract not sent',
        'processing' => 'Processing',
        'awaiting_signature' => 'Awaiting signature',
        'finished' => 'Finished',
    ];

    protected $fillable = [
        'uuid',
        'type',
        'status',
        'amount',
        'incc',
        'attachment',
        'personalization_description',
        'integration',
        'legal_document_status',
        'document_uuid',
        'mega_code',
        'integration_date',
        'sent_date',
    ];

    protected $casts = [
        'amount' => 'float',
        'incc' => 'boolean',
        'integration' => 'boolean',
        'integration_date' => 'datetime',
        'sent_date' => 'datetime',
    ];

    public static function boot(): void
    {
        parent::boot();
        self::creating(function ($model) {
            $additiveCode = PersonalizationAdditive::withTrashed()->max('code') ?? 1000050;
            $proposalCode = self::withTrashed()->max('code') ?? 1000050;
            $code = $additiveCode;
            if ($code < $proposalCode) {
                $code = $proposalCode;
            }
            $model->code = $code + 1;
        });
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class)->withoutGlobalScopes();
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id', 'id');
    }

    public function personalizations(): BelongsToMany
    {
        return $this->belongsToMany(Personalization::class, 'personalization_personalization_sale', 'personalization_sale_id', 'personalization_id');
    }

    public function final_personalizations(): BelongsToMany
    {
        return $this->belongsToMany(Personalization::class, 'personalization_personalization_sale_final', 'personalization_sale_id', 'personalization_id');
    }

    public function descriptions(): HasMany
    {
        return $this->hasMany(PersonalizationSaleDescription::class, 'personalization_sale_id', 'id');
    }

    public function periodicities(): HasMany
    {
        return $this->hasMany(PersonalizationSalePeriodicity::class, 'personalization_sale_id', 'id');
    }
}
