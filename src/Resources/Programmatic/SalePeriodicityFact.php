<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\Contracts\Resources\Programmatic\SalePeriodicityFactContract;

class SalePeriodicityFact implements SalePeriodicityFactContract
{
    private Sale $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    /**
     * @inheritDoc
     */
    public function create(string $sale_uuid, array $data): object
    {
        return $this->sale->programmatic->vendas->request->post(
            vsprintf(self::ENDPOINT_PREFIX, [$sale_uuid]),
            $data
        )->throw()->object();
    }
}
