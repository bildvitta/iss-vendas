<?php

namespace Bildvitta\IssVendas\Models\PersonalizationSale\Additives;

use Bildvitta\IssVendas\Models\PersonalizationSale\PersonalizationSale;
use Bildvitta\IssVendas\Models\Produto\Personalization;
use Bildvitta\IssVendas\Models\Sale;
use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;

/**
 * App\Models\PersonalizationSale\Additives\PersonalizationAdditive
 *
 * @property int $id
 * @property string $uuid
 * @property string $additive_type
 * @property string $status
 * @property string|null $legal_document_status
 * @property int $sale_id
 * @property int $personalization_sale_id
 * @property string|null $attachment
 * @property string|null $personalization_description
 * @property int $code
 * @property string|null $document_uuid
 * @property int $creator_id
 * @property float|null $actual_value
 * @property float|null $additive_value
 * @property float|null $amount
 * @property bool|null $incc
 * @property string|null $operation
 * @property string|null $discount_form
 * @property string|null $bank
 * @property string|null $bank_agency
 * @property string|null $bank_account
 * @property bool $is_integrated
 * @property \Illuminate\Support\Carbon|null $integration_sent_date
 * @property \Illuminate\Support\Carbon|null $integration_date
 * @property object|null $added_personalizations
 * @property object|null $removed_personalizations
 * @property object|null $new_personalizations
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read User $creator
 * @property-read Collection $final_added_personalizations
 * @property-read Collection $final_personalizations
 * @property-read Collection $final_removed_personalizations
 * @property-read Collection $get_added_personalizations
 * @property-read Collection $get_new_personalizations
 * @property-read Collection $get_removed_personalizations
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PersonalizationSale\Additives\PersonalizationAdditivePeriodicity> $periodicities
 * @property-read int|null $periodicities_count
 * @property-read PersonalizationSale $personalization_sale
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Personalization> $personalizations
 * @property-read int|null $personalizations_count
 * @property-read Sale $sale
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive onlyTrashed()
 * @method static Builder|BaseModel pagination()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive query()
 * @method static Builder|BaseModel search()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereActualValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereAddedPersonalizations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereAdditiveType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereAdditiveValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereBank($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereBankAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereBankAgency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereDiscountForm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereDocumentUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereIncc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereIntegrationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereIntegrationSentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereIsIntegrated($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereLegalDocumentStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereNewPersonalizations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereOperation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive wherePersonalizationDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive wherePersonalizationSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereRemovedPersonalizations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|PersonalizationAdditive withoutTrashed()
 * @mixin \Eloquent
 */
class PersonalizationAdditive extends Model
{
    use UsesVendasDB;
    use SoftDeletes;

    protected $table = 'personalization_additives';

    protected $connection = 'iss-vendas';

    public const STATUS = [
        'awaiting_sending_for_signature' => 'Awaiting sending for signature',
        'awaiting_signature' => 'Awaiting signature',
        'not_integrated' => 'Not integrated',
        'finished' => 'Finished',
        'canceled' => 'Canceled',
        'awaiting_integration' => 'Awaiting integration',
        'error_sending_for_signature' => 'Error sending for signature',
    ];

    public const ADDITIVE_TYPE = [
        'inclusion_with_value' => 'Inclusion with value',
        'inclusion_without_value' => 'Inclusion without value',
        'replacement_with_value' => 'Replacement with value',
        'replacement_without_value' => 'Replacement without value',
        'removal' => 'Removal',
    ];

    public const LEGAL_DOCUMENT_STATUS = [
        'not_sent' => 'Contract not sent',
        'processing' => 'Processing',
        'awaiting_signature' => 'Awaiting signature',
        'finished' => 'Finished',
    ];

    public const OPERATION = [
        'addition' => 'Addition',
        'subtraction' => 'Subtraction',
    ];

    public const DISCOUNT_FORM = [
        'in_the_next_installment' => 'In the next installment',
        'dilute_in_the_next_installments' => 'Dilute in the next installments',
        'in_the_last_installment' => 'In the last installment',
        'bank_transfer' => 'Bank transfer',
    ];

    protected $fillable = [
        'uuid',
        'additive_type',
        'status',
        'legal_document_status',
        'attachment',
        'personalization_description',
        'document_uuid',
        'actual_value',
        'additive_value',
        'amount',
        'incc',
        'operation',
        'discount_form',
        'bank',
        'bank_agency',
        'bank_account',
        'is_integrated',
        'integration_sent_date',
        'integration_date',
        'new_personalizations',
        'removed_personalizations',
        'added_personalizations',
    ];

    protected $casts = [
        'actual_value' => 'float',
        'additive_value' => 'float',
        'amount' => 'float',
        'is_integrated' => 'boolean',
        'integration_sent_date' => 'datetime',
        'integration_date' => 'datetime',
        'incc' => 'boolean',
        'new_personalizations' => 'object',
        'removed_personalizations' => 'object',
        'added_personalizations' => 'object',
    ];

    public static function boot(): void
    {
        parent::boot();
        self::creating(function ($model) {
            $additiveCode = self::withTrashed()->max('code') ?? 1000050;
            $proposalCode = PersonalizationSale::withTrashed()->max('code') ?? 1000050;
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

    public function personalization_sale(): BelongsTo
    {
        return $this->belongsTo(PersonalizationSale::class, 'personalization_sale_id', 'id');
    }

    // public function creator(): BelongsTo
    // {
    //     return $this->belongsTo(User::class, 'creator_id', 'id')->withTrashed();
    // }

    public function personalizations(): BelongsToMany
    {
        return $this->belongsToMany(Personalization::class, 'personalization_personalization_additive', 'personalization_additive_id', 'personalization_id');
    }

    public function periodicities(): HasMany
    {
        return $this->hasMany(PersonalizationAdditivePeriodicity::class, 'personalization_additive_id', 'id');
    }

    protected function finalAddedPersonalizations(): Attribute
    {
        return Attribute::make(get: function ($value): Collection {
            $addedPersonalizations = collect();
            if (in_array($this->additive_type, ['inclusion_with_value', 'inclusion_without_value', 'replacement_with_value', 'replacement_without_value'])) {
                $additivePersonalizations = $this->personalizations()->get();
                $personalizationSalePersonalizations = $this->personalization_sale->final_personalizations()->get();
                foreach ($additivePersonalizations as $additivePersonalization) {
                    $addedItem = true;
                    foreach ($personalizationSalePersonalizations as $personalizationSalePersonalization) {
                        if ($additivePersonalization->uuid === $personalizationSalePersonalization->uuid) {
                            $addedItem = false;
                        }
                    }
                    if ($addedItem) {
                        $addedPersonalizations->push($additivePersonalization);
                    }
                }
            }

            return $addedPersonalizations;
        });
    }

    protected function finalRemovedPersonalizations(): Attribute
    {
        return Attribute::make(get: function ($value): Collection {
            $removedPersonalizations = collect();
            $personalizationSaleFinalPersonalizations = $this->personalization_sale->final_personalizations()->get();
            $additivePersonalizations = $this->personalizations()->get();
            if (in_array($this->additive_type, ['replacement_with_value', 'replacement_without_value'])) {
                foreach ($personalizationSaleFinalPersonalizations as $parentPersonalization) {
                    $itemRemoved = true;
                    foreach ($additivePersonalizations as $additivePersonalization) {
                        if ($additivePersonalization->uuid === $parentPersonalization->uuid) {
                            $itemRemoved = false;
                        }
                    }
                    if ($itemRemoved) {
                        $removedPersonalizations->push($parentPersonalization);
                    }
                }
            } elseif ($this->additive_type === 'removal') {
                $removedPersonalizations = $additivePersonalizations;
            }

            return $removedPersonalizations;
        });
    }

    protected function finalPersonalizations(): Attribute
    {
        return Attribute::make(get: function ($value): Collection {
            $finalPersonalizationSales = $this->personalization_sale->final_personalizations()->get();
            $additivePersonalizations = $this->personalizations()->get();
            switch ($this->additive_type) {
                case 'inclusion_with_value':
                case 'inclusion_without_value':
                    $additivePersonalizations->each(fn ($additivePersonalization) => $finalPersonalizationSales->push($additivePersonalization));
                    return $finalPersonalizationSales;
                case 'replacement_with_value':
                case 'replacement_without_value':
                    return $additivePersonalizations;
                case 'removal':
                    return $finalPersonalizationSales->filter(fn ($finalPersonalizationSale) => !in_array($finalPersonalizationSale->id, $additivePersonalizations->pluck('id')->toArray()));
            }

            return collect();
        });
    }

    protected function getAddedPersonalizations(): Attribute
    {
        return Attribute::make(get: function ($value): Collection {
            if ($addedPersonalizations = $this->added_personalizations) {
                return Personalization::whereIn('id', $addedPersonalizations)->get();
            }
            return collect();
        });
    }

    protected function getRemovedPersonalizations(): Attribute
    {
        return Attribute::make(get: function ($value): Collection {
            if ($removedPersonalizations = $this->removed_personalizations) {
                return Personalization::whereIn('id', $removedPersonalizations)->get();
            }
            return collect();
        });
    }

    protected function getNewPersonalizations(): Attribute
    {
        return Attribute::make(get: function ($value): Collection {
            if ($newPersonalizations = $this->new_personalizations) {
                return Personalization::whereIn('id', $newPersonalizations)->get();
            }
            return collect();
        });
    }

    public function syncFinalPersonalizations(): void
    {
        if ($this->personalization_description) {
            $this->personalization_sale->descriptions()->create([
                'description' => $this->personalization_description,
            ]);

            return;
        }
        $this->personalization_sale->final_personalizations()->sync($this->final_personalizations);
    }
}
