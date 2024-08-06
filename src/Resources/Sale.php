<?php

namespace Bildvitta\IssVendas\Resources;

use Bildvitta\IssVendas\Contracts\Resources\SaleContract;
use Bildvitta\IssVendas\IssVendas;
use Illuminate\Http\Client\RequestException;

class Sale implements SaleContract
{
    private IssVendas $vendas;

    public function __construct(IssVendas $vendas)
    {
        $this->vendas = $vendas;
    }

    /**
     * @throws RequestException
     */
    public function find(string $uuid): object
    {
        return $this->vendas->request->get(vsprintf(self::ENDPOINT_FIND_BY_UUID, [$uuid]))->throw()->object();
    }
}
