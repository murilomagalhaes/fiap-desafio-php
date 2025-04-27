<?php

namespace App\Domain\Students;

use App\Shared\Database\BaseModel;

class StudentsModel extends BaseModel
{
    protected string $table = 'students';

    protected array $columns = [
        'id',
        'name',
        'email',
        'password',
        'cpf',
        'birth_date',
    ];

    public function paginateWithEnrollmentsCount(int $page = 1, int $perPage = 10, $search = ''): \stdClass
    {
        return $this->paginate(
            $page,
            $perPage,
            'SELECT students.*, (SELECT COUNT(*) FROM enrollments WHERE enrollments.student_id = students.id) AS enrollments_count',
            "WHERE students.name LIKE :search",
            '',
            'ORDER BY students.name',
            ['search' => "%$search%"],
        );
    }
}