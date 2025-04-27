<?php

namespace App\Domain\Classes;

use App\Shared\Database\BaseModel;

class ClassesModel extends BaseModel
{
    protected string $table = 'classes';

    protected array $columns = [
        'id',
        'name',
        'description'
    ];

    public function paginateWithStudentsCount(int $page = 1, int $perPage = 10, string $search = ''): \stdClass
    {
        return $this->paginate(
            $page,
            $perPage,
            'SELECT classes.*, (SELECT COUNT(*) FROM enrollments WHERE enrollments.class_id = classes.id) AS students_count',
            "WHERE classes.name LIKE :search",
            '',
            'ORDER BY classes.name',
            ['search' => "%$search%"]
        );
    }
}