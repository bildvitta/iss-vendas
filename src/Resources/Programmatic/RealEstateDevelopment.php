<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\Contracts\Resources\Programmatic\RealEstateDevelopmentContract;

class RealEstateDevelopment implements RealEstateDevelopmentContract
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

    public function units()
    {
        return new Unit($this->programmatic);
    }
}
