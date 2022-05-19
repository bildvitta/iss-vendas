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
     * @param array $query
     *
     * @return object
     */
    public function integrations(array $query = []): object
    {
        return $this->programmatic->vendas->request->get(self::ENDPOINT_INTEGRATIONS, $query)->throw()->object();
    }
}
