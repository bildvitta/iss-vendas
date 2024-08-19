<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\Contracts\Resources\Programmatic\SaleContract;
use Illuminate\Http\Client\RequestException;

class Sale implements SaleContract
{
    public Programmatic $programmatic;

    public function __construct(Programmatic $programmatic)
    {
        $this->programmatic = $programmatic;
    }

    /**
     * @return SaleStep
     */
    public function steps()
    {
        return new SaleStep($this);
    }

    /**
     * @return SaleFact
     */
    public function facts()
    {
        return new SaleFact($this);
    }

    /**
     * @return SalePeriodicityFact
     */
    public function periodicityFacts(): SalePeriodicityFact
    {
        return new SalePeriodicityFact($this);
    }

    /**
     * @return SalePersonalization
     */
    public function personalizations()
    {
        return new SalePersonalization($this);
    }

    /**
     * @throws RequestException
     */
    public function find(string $uuid): object
    {
        return $this->programmatic->vendas->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }

    public function update(string $uuid, array $data): object
    {
        return $this->programmatic->vendas->request->patch(vsprintf(self::ENDPOINT_UPDATE, [$uuid]), $data)->throw()->object();
    }
}
