<?php

namespace App\Domain\Staff;

use App\Shared\Database\BaseModel;

class StaffModel extends BaseModel
{
    protected string $table = 'staff';

    protected array $columns = [
        'id',
        'name',
        'email',
        'password'
    ];

}