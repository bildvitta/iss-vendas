<?php

namespace Bildvitta\IssVendas\Contracts\Resources\Programmatic;

interface CustomerContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/crm/customers/callback';

    /**
     * @const string
     */
    public const ENDPOINT_FIND_BY_UUID = self::ENDPOINT_PREFIX.'/%s';
}
