<?php

namespace Bildvitta\IssVendas\Traits;

trait UsesVendasDB
{
    public function __construct(array $attributes = [])
    {
        $this->configDbConnection();
        parent::__construct($attributes);
    }

    public static function __callStatic($method, $parameters)
    {
        self::configDbConnection();
        return parent::__callStatic($method, $parameters);
    }

    protected static function configDbConnection()
    {
        config([
            'database.connections.iss-vendas' => [
                'driver' => 'mysql',
                'host' => config('iss-vendas.db.host'),
                'port' => config('iss-vendas.db.port'),
                'database' => config('iss-vendas.db.database'),
                'username' => config('iss-vendas.db.username'),
                'password' => config('iss-vendas.db.password'),
                'unix_socket' => env('DB_SOCKET', ''),
                'charset' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'prefix' => '',
                'prefix_indexes' => true,
                'strict' => true,
                'engine' => null,
                'options' => [],
            ]
        ]);
    }
}
