<?php

namespace Bildvitta\IssVendas\Contracts\Resources\Programmatic;

interface UnitContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/products/%s/unities';

    /**
     * @const string
     */
    public const ENDPOINT_FIND_BY_UUID = self::ENDPOINT_PREFIX . '/%s';

    /**
     * @param string $refRealEstateDevelopment
     * @param string $refUnit
     *
     * @return object
     */
    public function find(string $refRealEstateDevelopment, string $refUnit): object;
}
