<?php

namespace Bildvitta\IssVendas\Contracts;

use Bildvitta\IssVendas\Resources\Sale;

interface IssVendasFactory
{
    /**
     * @const array
     */
    public const DEFAULT_HEADERS = [
        'content-type' => 'application/json',
        'accept' => 'application/json',
        'User-Agent' => 'ISS v0.0.1-alpha',
    ];

    /**
     * @const array
     */
    public const DEFAULT_OPTIONS = ['allow_redirects' => false];

    /**
     * @return Sale
     */
    public function sale(): Sale;
}
