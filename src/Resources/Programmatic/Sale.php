<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\Contracts\Resources\Programmatic\SaleContract;
use Bildvitta\IssVendas\IssVendas;
use Illuminate\Http\Client\RequestException;

class Sale implements SaleContract
{
    /**
     * @var IssVendas
     */
    private IssVendas $vendas;

    /**
     * @param  IssVendas  $vendas
     */
    public function __construct(IssVendas $vendas)
    {
        $this->vendas = $vendas;
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
        return $this->vendas->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }
}
