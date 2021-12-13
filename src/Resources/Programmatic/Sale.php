<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\Contracts\Resources\Programmatic\SaleContract;
use Illuminate\Http\Client\RequestException;

class Sale implements SaleContract
{
    /**
     * @var Programmatic
     */
    private Programmatic $programmatic;

    /**
     * @param  Programmatic  $vendas
     */
    public function __construct(Programmatic $vendas)
    {
        $this->programmatic = $vendas;
    }

    /**
     * @param  string  $uuid
     *
     * @return object
     *
     * @throws RequestException
     */
    public function find(string $uuid): object
    {
        return $this->programmatic->vendas->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }
}
