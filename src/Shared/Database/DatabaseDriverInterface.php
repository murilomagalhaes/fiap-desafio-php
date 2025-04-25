<?php

namespace App\Shared\Database;

interface DatabaseDriverInterface
{
    public function get(): array;

    public function find(): \stdClass;

    public function update($id, array $data): ?\stdClass;

    public function insert(array $data): ?\stdClass;
}