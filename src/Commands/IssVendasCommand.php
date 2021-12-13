<?php

namespace Bildvitta\IssVendas\Commands;

use Illuminate\Console\Command;

class IssVendasCommand extends Command
{
    public $signature = 'iss-vendas';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
