<?php

namespace App\Domain\Enrollments;

use App\Shared\Http\{Request, Response};
use App\Domain\Students\StudentsModel;
use App\Domain\Classes\ClassesModel;

class EnrollmentsValidation
{
    public static function validate(Request $request): void
    {
        $classId = $request->get('class_id');
        $studentId = $request->get('student_id');

        $response = new Response();

        $student = (new StudentsModel())->findBy('id', $studentId);
        $class = (new ClassesModel())->findBy('id', $classId);
        $alreadyEnrolled = (new EnrollmentsModel())->count('WHERE student_id = :studentId AND class_id = :classId', compact('studentId', 'classId'));

        if (!$classId || !$studentId) {
            $response->flash('error', 'Aluno ou turma inválidos')
                ->redirect('/admin/classes');
        }

        if ($alreadyEnrolled) {
            $response->flash('error', "Aluno já matriculado nesta turma")
                ->redirect("/admin/classes/form?id=$classId");;
        }
        if (!$student || !$class) {
            $response->flash('error', "Aluno ou matrícula inválidos")
                ->redirect("/admin/classes/form?id=$classId");;
        }

    }
}