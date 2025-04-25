<?php

namespace App\Domain\Staff;

use App\Shared\Database\BaseModel;

class StaffModel extends BaseModel
{

    public function findByEmail(string $email): ?\stdClass
    {
        $statement = $this->connection->prepare("SELECT * FROM staff WHERE email = :email LIMIT 1");

        $statement->execute(compact('email'));

        return $statement->fetchObject() ?: null;
    }
}