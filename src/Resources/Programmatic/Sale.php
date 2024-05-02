<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\Contracts\Resources\Programmatic\SaleContract;
use Illuminate\Http\Client\RequestException;

class Sale implements SaleContract
{
    /**
     * @var Programmatic
     */
    public Programmatic $programmatic;

    /**
     * @param Programmatic $programmatic
     */
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
     * @return SalePersonalization
     */
    public function personalizations()
    {
        return new SalePersonalization($this);
    }

    /**
     * @param string $uuid
     *
     * @return object
     *
     * @throws RequestException
     */
    public function find(string $uuid): object
    {
        return $this->programmatic->vendas->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }

    /**
     * @param  string  $uuid
     * @param array $data
     *
     * @return object
     */
    public function update(string $uuid, array $data): object
    {
        return $this->programmatic->vendas->request->patch(vsprintf(self::ENDPOINT_UPDATE, [$uuid]), $data)->throw()->object();
    }
}
