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

    public function find(string $uuid): object;

    public function update(string $uuid, array $data): object;
}
