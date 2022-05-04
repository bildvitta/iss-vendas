<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\IssVendas;

class Programmatic
{
    /**
     * @var IssVendas
     */
    public IssVendas $vendas;

    /**
     * @param IssVendas $vendas
     */
    public function __construct(IssVendas $vendas)
    {
        $this->vendas = $vendas;
    }

    /**
     * @return Sale
     */
    public function sale(): Sale
    {
        return new Sale($this);
    }

    /**
     * @return RealEstateDevelopment
     */
    public function realEstateDevelopment(): RealEstateDevelopment
    {
        return new RealEstateDevelopment($this);
    }
}
