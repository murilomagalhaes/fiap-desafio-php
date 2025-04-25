<?php

namespace App\Shared\Database;

use App\Shared\Http\Response;
use PDO;

class MySQLDriver
{
    private PDO $connection;

    public function __construct()
    {
        $env = parse_ini_file(__DIR__ . '/../../../.env');

        [$host, $port, $database, $user, $password] = [
            $env['DB_HOST'] ?? '127.0.0.1',
            $env['DB_PORT'] ?? '3306',
            $env['DB_NAME'] ?? null,
            $env['DB_USER'] ?? null,
            $env['DB_PASSWORD'] ?? ''
        ];

        try {
            $this->connection = new PDO(
                "mysql:host=$host;port=$port;dbname=$database",
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                ]
            );
        } catch (\PDOException $e) {
            (new Response())
                ->status(400)
                ->view('errors/server-error', ['message' => $e->getMessage()]);
        }


    }

    public function getConnection(): \PDO
    {
        return $this->connection;
    }
}