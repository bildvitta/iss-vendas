<?php

namespace Bildvitta\IssVendas\Contracts\Resources\Programmatic;

interface UnitContract
{
    /**
     * @const string
     */
    public const ENDPOINT_FIND = '/programmatic/units/%s';

    /**
     * @const string
     */
    public const ENDPOINT_UPDATE = '/programmatic/units/%s';

    /**
     * @param string $refRealEstateDevelopment
     * @param string $refUnit
     *
     * @return object
     */
    public function find(string $uuid): object;

    /**
     * @param string $refRealEstateDevelopment
     * @param string $refUnit
     * @param array $data
     *
     * @return object
     */
    public function update(string $uuid, array $data): object;
}
