<?php

namespace App\Shared\Database;

interface DatabaseDriverInterface
{
    public function getConnection(): \PDO;
}