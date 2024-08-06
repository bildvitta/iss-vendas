<?php

namespace Bildvitta\IssVendas\Resources\Programmatic;

use Bildvitta\IssVendas\IssVendas;

class Programmatic
{
    public IssVendas $vendas;

    public function __construct(IssVendas $vendas)
    {
        $this->vendas = $vendas;
    }

    public function sale(): Sale
    {
        return new Sale($this);
    }

    public function realEstateDevelopment(): RealEstateDevelopment
    {
        return new RealEstateDevelopment($this);
    }

    public function units()
    {
        return new Unit($this);
    }

    public function customers(): Customer
    {
        return new Customer($this);
    }
}
