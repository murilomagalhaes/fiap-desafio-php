<?php

namespace App\Shared\Database;

class BaseModel
{
    private DatabaseDriverInterface $databaseDriver;

    protected \PDO $connection;

    public function __construct()
    {
        $this->databaseDriver = new MySQLDriver();

        $this->connection = $this->databaseDriver->getConnection();
    }
}