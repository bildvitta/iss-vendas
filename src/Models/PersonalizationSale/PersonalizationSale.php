<?php

namespace Bildvitta\IssVendas\Models\PersonalizationSale;

use Bildvitta\IssVendas\Models\PersonalizationSale\Additives\PersonalizationAdditive;
use Bildvitta\IssVendas\Models\Produto\Personalization;
use Bildvitta\IssVendas\Models\Sale;
use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\PersonalizationSale\PersonalizationSale
 *
 * @property int $id
 * @property string $uuid
 * @property string $type
 * @property string $status
 * @property int $sale_id
 * @property float $amount
 * @property bool $incc
 * @property string|null $attachment
 * @property string|null $personalization_description
 * @property int $code
 * @property bool $integration
 * @property string|null $legal_document_status
 * @property string|null $document_uuid
 * @property int|null $mega_code
 * @property \Illuminate\Support\Carbon|null $sent_date
 * @property \Illuminate\Support\Carbon|null $integration_date
 * @property int $creator_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $creator
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PersonalizationSale\PersonalizationSaleDescription> $descriptions
 * @property-read int|null $descriptions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Personalization> $final_personalizations
 * @property-read int|null $final_personalizations_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PersonalizationSale\PersonalizationSalePeriodicity> $periodicities
 * @property-read int|null $periodicities_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Personalization> $personalizations
 * @property-read int|null $personalizations_count
 * @property-read Sale $sale
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale onlyTrashed()
 * @method static Builder|BaseModel pagination()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale query()
 * @method static Builder|BaseModel search()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereDocumentUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereIncc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereIntegration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereIntegrationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereLegalDocumentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereMegaCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale wherePersonalizationDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereSentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationSale withoutTrashed()
 * @mixin \Eloquent
 */
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

    // public function creator(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'creator_id', 'id');
    // }

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
