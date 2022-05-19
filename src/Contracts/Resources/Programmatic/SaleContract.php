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
    public const ENDPOINT_INTEGRATIONS = self::ENDPOINT_PREFIX.'/integrations';

    /**
     * @param  string  $uuid
     *
     * @return object
     */
    public function find(string $uuid): object;
}
