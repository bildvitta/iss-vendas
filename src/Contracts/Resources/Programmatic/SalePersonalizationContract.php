<?php

namespace Bildvitta\IssVendas\Contracts\Resources\Programmatic;

use Illuminate\Http\Client\RequestException;

interface SalePersonalizationContract
{
    /**
     * @const string
     */
    public const ENDPOINT_PREFIX = '/programmatic/sales/personalizations';

    /**
     * @const string
     */
    public const ENDPOINT_UPDATE = '/programmatic/sales/personalizations/%s';

    /**
     * @const string
     */
    public const ENDPOINT_DELETE = '/programmatic/sales/personalizations/%s';

    /**
     * @throws RequestException
     */
    public function create(array $data): object;

    /**
     * @throws RequestException
     */
    public function update(string $uuid, array $data): object;

    /**
     * @throws RequestException
     */
    public function delete(string $uuid): object;
}
