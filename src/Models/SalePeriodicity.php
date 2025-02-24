<?php

namespace Bildvitta\IssVendas\Models;

use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Carbon;

/**
 * App\Models\SalePeriodicity
 *
 * @property int $id
 * @property string $uuid
 * @property int $sale_id
 * @property string $periodicity
 * @property int $installments
 * @property float $installment_price
 * @property float|null $installment_amount
 * @property bool $editable
 * @property string|null $payment_method
 * @property Carbon $due_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read \App\Models\Sale $sale
 *
 * @method static \Database\Factories\SalePeriodicityFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity onlyTrashed()
 * @method static Builder|BaseModel pagination()
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity query()
 * @method static Builder|BaseModel search()
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereDueAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereEditable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereInstallmentAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereInstallmentPrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereInstallments($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity wherePeriodicity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|SalePeriodicity withoutTrashed()
 *
 * @mixin Eloquent
 */
class SalePeriodicity extends Model
{
    use SoftDeletes;
    use UsesVendasDB;

    public const PERIODICITY_LIST = [
        // produto
        'financing' => 'Financiamento',
        'fgts' => 'FGTS',
        'subsidy' => 'Subsídio',
        'down_payment' => 'Entrada',
        'intermediate' => 'Intermediária',
        'post_construction' => 'Pós-obra',
        'monthly' => 'Mensal',
        'bimonthly' => 'Bimestral',
        'quarterly' => 'Trimestral',
        'semiannual' => 'Semestral',
        'yearly' => 'Anual',
        'conclusion_balance' => 'Saldo Conclusão',
        'conclusion_keys' => 'Conclusão chaves',
        //vendas
        'signal' => 'Sinal',
        'periodicity' => 'Periodicidade',
        'final' => 'Final',
        'single' => 'Única',
        'single_financing' => 'Única - Financiamento',
        'vehicle_exchange' => 'Dação em pagamento - Veículo',
        'real_estate_development_exchange' => 'Dação em pagamento - Imóvel',
    ];

    /**
     * @const array[]
     */
    public const PAYMENT_METHOD = [
        'bank_slip' => 'Boleto',
        'bank' => 'Banco',
        'credit_card' => 'Cartão',
    ];

    /*
     * 00 - Aguardando Json
     * 10 - Processado
     * 20 - Baixado
     * 30 - Integrado com o Oracle
     * 40 - Integrado com o Mega
     * 80 - Cancelado
     * 99 - Processado com Erro
     */
    public const PERIODICITY_STATUS_FROM_MEGA = [
        '0' => [
            'label' => 'Não gerado',
            'value' => 'not-generated',
        ],
        '10' => [
            'label' => 'Em aberto',
            'value' => 'is-open',
        ],
        '20' => [
            'label' => 'Pago',
            'value' => 'paid',
        ],
        '80' => [
            'label' => 'Cancelado',
            'value' => 'canceled',
        ],
        '99' => [
            'label' => 'Não gerado',
            'value' => 'not-generated',
        ],
        'unknown' => [
            'label' => 'Desconhecido',
            'value' => 'unknown',
        ],
    ];

    protected $fillable = [
        'uuid',
        'proposal_model_id',
        'periodicity',
        'installments',
        'installment_price',
        'installment_amount',
        'due_at',
        'editable',
        'payment_method',
    ];

    protected $casts = [
        'due_at' => 'date:Y-m-d',
        'installment_amount' => 'real',
        'editable' => 'boolean',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }
}
