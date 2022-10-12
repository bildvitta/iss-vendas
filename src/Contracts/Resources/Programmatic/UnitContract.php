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
     * @const string
     */
    public const ENDPOINT_UPDATE= self::ENDPOINT_PREFIX . '/%s';

    /**
     * @param string $refRealEstateDevelopment
     * @param string $refUnit
     *
     * @return object
     */
    public function find(string $refRealEstateDevelopment, string $refUnit): object;

    /**
     * @param string $refRealEstateDevelopment
     * @param string $refUnit
     * @param array $data
     *
     * @return object
     */
    public function update(string $refRealEstateDevelopment, string $refUnit, array $data): object;
}
