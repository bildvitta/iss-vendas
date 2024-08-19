<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\Contracts\Resources\Programmatic\CustomerContract;

class Customer implements CustomerContract
{
    /**
     * @var Programmatic
     */
    private Programmatic $programmatic;

    /**
     * @param Programmatic $vendas
     */
    public function __construct(Programmatic $vendas)
    {
        $this->programmatic = $vendas;
    }

    /**
     * @inheritDoc
     */
    public function create(string $customer_uuid): object
    {
        return $this->programmatic->vendas->request->post(
            self::ENDPOINT_PREFIX,
            ['ref_uuid' => $customer_uuid]
        )->throw()->object();
    }
}
