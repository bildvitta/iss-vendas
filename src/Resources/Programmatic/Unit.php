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
     * @param Programmatic $vendas
     */
    public function __construct(Programmatic $vendas)
    {
        $this->programmatic = $vendas;
    }

    /**
     * @inheritDoc
     */
    public function find(string $refRealEstateDevelopment, string $refUnit): object
    {
        return $this->programmatic->vendas->request->get(
            vsprintf(self::ENDPOINT_FIND_BY_UUID, [$refRealEstateDevelopment, $refUnit])
        )->throw()->object();
    }

    /**
     * @inheritDoc
     */
    public function update(string $refRealEstateDevelopment, string $refUnit, array $data): object
    {
        return $this->programmatic->vendas->request->patch(vsprintf(self::ENDPOINT_UPDATE, [$refRealEstateDevelopment, $refUnit]), $data)->throw()->object();
    }
}
