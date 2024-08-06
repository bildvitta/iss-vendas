<?php

namespace Bildvitta\IssVendas\Contracts\Resources\Programmatic;

interface SaleStepContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/sales/steps';

    /**
     * @const string
     */
    public const ENDPOINT_FIND_BY_UUID = self::ENDPOINT_PREFIX.'/%s';

    public function find(string $uuid): object;

    public function search(array $query = [], array $body = []): object;
}
