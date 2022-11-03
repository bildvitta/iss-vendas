<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\Contracts\Resources\Programmatic\UnitContract;

class Unit implements UnitContract
{
    /**
     * @var Programmatic
     */
    private Programmatic $programmatic;

    /**
     * @param Programmatic $programmatic
     */
    public function __construct(Programmatic $programmatic)
    {
        $this->programmatic = $programmatic;
    }

    /**
     * @inheritDoc
     */
    public function find(string $uuid): object
    {
        return $this->programmatic->vendas->request->get(
            vsprintf(self::ENDPOINT_FIND, [$uuid])
        )->throw()->object();
    }

    /**
     * @inheritDoc
     */
    public function update(string $uuid, array $data): object
    {
        return $this->programmatic->vendas->request->patch(
            vsprintf(self::ENDPOINT_UPDATE, [$uuid]),
            $data
        )->throw()->object();
    }
}
