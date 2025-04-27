<?php

namespace App\Domain\Enrollments;

use App\Shared\Database\BaseModel;

class EnrollmentsModel extends BaseModel
{
    protected string $table = 'enrollments';

    protected array $columns = [
        'id',
        'student_id',
        'class_id',
    ];

    public function getByStudent($studentId): array
    {
        $statement = $this->connection->prepare("
        SELECT
            enrollments.id,
            enrollments.student_id,
            enrollments.class_id,
            classes.name AS class_name,
            CONCAT(students.name, ' (', students.email, ')') AS student
        FROM enrollments
        LEFT JOIN classes ON classes.id = enrollments.class_id
        LEFT JOIN students ON students.id = enrollments.student_id
        WHERE enrollments.student_id = :student_id
        ");

        $statement->bindParam(':student_id', $studentId, \PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function getByClass($classId): array
    {
        $statement = $this->connection->prepare("
        SELECT
            enrollments.id,
            enrollments.student_id,
            enrollments.class_id,
            classes.name AS class_name,
            CONCAT(students.name, ' (', students.email, ')') AS student
        FROM enrollments
        LEFT JOIN classes ON classes.id = enrollments.class_id
        LEFT JOIN students ON students.id = enrollments.student_id
        WHERE enrollments.class_id = :class_id
        ");

        $statement->bindParam(':class_id', $classId, \PDO::PARAM_INT);

        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

}