<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\Contracts\Resources\Programmatic\SalePersonalizationContract;

class SalePersonalization implements SalePersonalizationContract
{
    private Sale $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    /**
     * {@inheritDoc}
     */
    public function create(array $data): object
    {
        return $this->sale->programmatic->vendas->request->post(
            self::ENDPOINT_PREFIX,
            $data
        )->throw()->object();
    }

    /**
     * {@inheritDoc}
     */
    public function update(string $uuid, array $data): object
    {
        return $this->sale->programmatic->vendas->request->patch(
            vsprintf(self::ENDPOINT_UPDATE, [$uuid]),
            $data
        )->throw()->object();
    }

    /**
     * {@inheritDoc}
     */
    public function delete(string $uuid): object
    {
        return $this->sale->programmatic->vendas->request->delete(
            vsprintf(self::ENDPOINT_DELETE, [$uuid])
        )->throw()->object();
    }
}
