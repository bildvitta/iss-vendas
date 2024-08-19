<?php

namespace Bildvitta\IssVendas\Contracts\Resources\Programmatic;

use Illuminate\Http\Client\RequestException;

interface SaleFactContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/sales/%s/facts';


    /**
     * @param string $sale_uuid
     * @param array $data
     *
     * @return object
     *
     * @throws RequestException
     */
    public function create(string $sale_uuid, array $data): object;
}
