<?php

namespace Bildvitta\IssVendas\Models;

use Bildvitta\IssVendas\Models\Crm\Customer;
use Bildvitta\IssVendas\Models\PersonalizationSale\Additives\PersonalizationAdditive;
use Bildvitta\IssVendas\Models\PersonalizationSale\PersonalizationSale;
use Bildvitta\IssVendas\Models\Produto\Unit;
use Bildvitta\IssVendas\Models\Sale\Personalization;
use Bildvitta\IssVendas\Traits\UsesVendasDB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sale extends Model
{
    use UsesVendasDB;
    use SoftDeletes;

    protected $connection = 'iss-vendas';

    protected $table = 'sales';

    public const STATUS = [
        'permutation' => 'Permutante',      // 10 - Permutante - Reserva para permutante

        'simulation' => 'Simulação',        // 15 - Interesse - Unidade selecionada
        'in_approval' => 'Em aprovação',    // 15 - Interesse - Unidade selecionada
        'reproved' => 'Recusada',           // 15 - Interesse - Unidade selecionada
        'processing' => 'Processando',      // 15 - Interesse - Unidade selecionada
        'failed' => 'Falhou',               // 15 - Interesse - Unidade selecionada

        'pre_sold' => 'Pré-Venda',          // 30 - Pré-venda - Proposta aprovada
        'commercial' => 'Comercial',        // 35 - Comercial - Impressão do contrato
        'legal' => 'Jurídico',              // 40 - Bild Jurídico / Vitta assinado - Validação comercial do contrato
        'credit' => 'Crédito',              // 45 - Crédito imobiliário/Repasse - Validação jurídica do contrato
        'sold' => 'Vendida',                // 50 - Vendido - Venda validada
        'distracted' => 'Distrato',         // 55 - Venda distratada - Venda distratada
        'canceled' => 'Cancelada',          // 60 - Venda cancelada - Venda cancelada
    ];

    public const COMMISSION_OPTIONS = [
        'sales_team' => 'Equipe de Vendas',
        'external_real_estate' => 'Imobiliária Externa',
    ];

    public const DEFAULT_COMMISSION = [
        'real_estate_broker' => 1.2,
        'supervisor' => 0.5,
        'manager' => 0.2,
        'real_estate' => 5,
    ];

    public const LEGAL_DOCUMENT_STATUS = [
        'not_sent' => 'Contrato não enviado',
        'processing' => 'Em Processamento',
        'awaiting_signature' => 'Aguardando assinatura',
        'finished' => 'Finalizado',
    ];

    public const LEGAL_DOCUMENT_SIGNATURE_TYPE = [
        'digital_not_presencial' => 'Assinatura digital',
        'digital_is_presencial' => 'Assinatura via tablet',
        'printed' => 'Impresso',
    ];

    protected $fillable = [
        'real_estate_development_id',
        'user_hub_seller_id',
        'unit_id',
        'hub_company_real_estate_agency_id',
        'user_hub_manager_id',
        'user_hub_supervisor_id',
        'crm_customer_id',
        'blueprint_id',
        'proposal_model_id',
        'buying_options_id',
        'uuid',
        'external_code',
        'contract_ref_uuid',
        'concretized',
        'special_needs',
        'input',
        'price_total',
        'original_unit_fixed_price',
        'original_unit_table_price',
        'is_insurance',
        'commission_option',
        'commission_manager',
        'commission_supervisor',
        'commission_seller',
        'commission_real_estate',
        'commission_declaration',
        'justified',
        'customer_justified',
        'customer_justified_at',
        'justified_at',
        'justified_user_id',
        'made_at',
        'made_by',
        'status',
        'legal_document_status',
        'signed_contract_at',
        'bill_paid_at',
        'crm_credit_process_simulator_id',
        'generate_signal_payment_at',
    ];

    protected $casts = [
        'special_needs' => 'bool',
        'fgts' => 'float',
        'financing' => 'float',
        'subsidy' => 'float',
        'input' => 'float',
        'price_total' => 'float',
        'original_unit_fixed_price' => 'float',
        'original_unit_table_price' => 'float',
        'commission_manager' => 'float',
        'commission_supervisor' => 'float',
        'commission_seller' => 'float',
        'commission_real_estate' => 'float',
        'justified_at' => 'datetime',
        'signed_contract_at' => 'datetime',
        'is_insurance' => 'bool',
        'bill_paid_at' => 'datetime',
        'commission_declaration' => 'boolean',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id')
            ->withTrashed();
    }

    public function personalizations(): HasMany
    {
        return $this->hasMany(Personalization::class, 'sale_id', 'id');
    }

    public function personalization_sales(): HasMany
    {
        return $this->hasMany(PersonalizationSale::class, 'sale_id', 'id');
    }

    public function personalization_additives(): HasMany
    {
        return $this->hasMany(PersonalizationAdditive::class, 'sale_id', 'id');
    }

    public function has_personalization(): int
    {
        return $this->personalizations()->count();
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'crm_customer_id', 'id')->withTrashed();
    }
}
