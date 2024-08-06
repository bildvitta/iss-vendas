<?php

namespace Bildvitta\IssVendas\Contracts\Resources\Programmatic;

interface RealEstateDevelopmentContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/products';

    /**
     * @const string
     */
    public const ENDPOINT_FIND_BY_UUID = self::ENDPOINT_PREFIX.'/%s';
}
