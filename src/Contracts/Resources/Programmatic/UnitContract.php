<?php

namespace Bildvitta\IssVendas\Contracts\Resources\Programmatic;

interface UnitContract
{
    /**
     * @const string
     */
    public const ENDPOINT_FIND = '/programmatic/produto/units/%s';

    /**
     * @const string
     */
    public const ENDPOINT_UPDATE = '/programmatic/produto/units/%s';

    /**
     * @param string $uuid
     *
     * @return object
     */
    public function find(string $uuid): object;

    /**
     * @param string $uuid
     * @param array $data
     *
     * @return object
     */
    public function update(string $uuid, array $data): object;
}
