<?php

namespace Bildvitta\IssVendas\Contracts\Resources\Programmatic;

interface SaleContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/sales';

    /**
     * @const string
     */
    public const ENDPOINT_FIND_BY_UUID = self::ENDPOINT_PREFIX.'/%s';

    /**
     * @const string
     */
    public const ENDPOINT_UPDATE = self::ENDPOINT_PREFIX.'/%s';

    public function find(string $uuid): object;

    public function update(string $uuid, array $data): object;
}
