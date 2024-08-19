<?php

namespace Bildvitta\IssVendas\Models\PersonalizationSale;

use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalizationSalePeriodicity extends Model
{
    use UsesVendasDB;
    use SoftDeletes;

    protected $table = 'personalization_sale_periodicities';
    protected $connection = 'iss-vendas';

    public const PERIODICITY = [
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
        'signal' => 'Sinal',
        'periodicity' => 'Periodicidade',
        'final' => 'Final',
        'vehicle_exchange' => 'Dação em pagamento - Veículo',
        'real_estate_development_exchange' => 'Dação em pagamento - Imóvel',
    ];

    public const PAYMENT_METHOD = [
        'bank_slip' => 'Boleto',
        'bank' => 'Banco',
        'credit_card' => 'Cartão',
    ];

    protected $fillable = [
        'uuid',
        'periodicity',
        'installments',
        'installment_price',
        'installment_amount',
        'payment_method',
        'due_at',
        'last_due_at',
    ];

    protected $casts = [
        'installment_price' => 'float',
        'installment_amount' => 'float',
        'due_at' => 'date:Y-m-d',
        'last_due_at' => 'date:Y-m-d',
    ];

    public function personalization_sale(): BelongsTo
    {
        return $this->belongsTo(PersonalizationSale::class, 'personalization_sale_id', 'id');
    }
}
