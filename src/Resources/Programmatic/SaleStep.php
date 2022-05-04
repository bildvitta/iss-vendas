<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\Contracts\Resources\Programmatic\SaleStepContract;

class SaleStep implements SaleStepContract
{
    private Sale $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    /**
     * @param array $query
     * @param array $body
     * @return object
     */
    public function search(array $query = [], array $body = []): object
    {
        $url = self::ENDPOINT_PREFIX;

        $request = $this->sale->programmatic->vendas->request;

        if ($body) {
            $request->withBody(json_encode($body), 'application/json');
        }

        return $request->get($url, $query)->throw()->object();
    }

    public function find(string $uuid): object
    {
        // TODO: Implement find() method.
    }
}
