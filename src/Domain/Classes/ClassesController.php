<?php

namespace App\Domain\Classes;

use App\Shared\Interfaces\HasMiddlewareInterface;
use App\Domain\Enrollments\EnrollmentsValidation;
use App\Domain\Enrollments\EnrollmentsModel;
use App\Shared\Http\{Request, Response};
use App\Domain\Students\StudentsModel;
use App\Shared\Http\AuthMiddleware;

class ClassesController implements HasMiddlewareInterface
{

    public function middlewares(): array
    {
        return [AuthMiddleware::class];
    }

    public function index(Request $request, Response $response): void
    {
        $page = (int)$request->get('page') ?: 1;

        if ($page < 1) $response->redirect('/admin/classes');

        $search = $request->get('search', '');

        $response->view('classes/index', [
            'classes' => (new ClassesModel())->paginateWithStudentsCount($page, 10, $search)
        ]);
    }

    public function create(Request $request, Response $response): void
    {
        ClassesValidation::validate($request);

        (new ClassesModel())->create([
            'name' => $request->get('nome'),
            'description' => $request->get('descricao')
        ]);

        $response->flash('success', 'Turma criada com sucesso')
            ->redirect('/admin/classes');
    }

    public function form(Request $request, Response $response): void
    {
        $classId = $request->get('id');

        $class = (new ClassesModel())->findBy('id', $classId);
        $enrollments = (new EnrollmentsModel())->getByClass($classId);
        $students = (new StudentsModel())->get(
            'SELECT *',
            'WHERE students.id NOT IN (SELECT student_id FROM enrollments WHERE class_id = :class_id)',
            '',
            'ORDER BY students.name',
            ['class_id' => $classId]
        );

        $response->view('classes/form', compact('class', 'enrollments', 'students'));
    }

    public function update(Request $request, Response $response): void
    {
        ClassesValidation::validate($request);

        $id = $request->get('id');

        (new ClassesModel())->update($id, [
            'name' => $request->get('nome'),
            'description' => $request->get('descricao')
        ]);

        $response->flash('success', 'Turma atualizada com sucesso')
            ->redirect("/admin/classes/form?id=$id");
    }

    public function delete(Request $request, Response $response): void
    {
        try {
            (new ClassesModel())->delete($request->get('id'));
            $response->flash('success', 'Turma excluída com sucesso')
                ->redirect('/admin/classes');
        } catch (\Throwable $th) {
            $response->flash('error', "Não foi possível excluir a turma. {$th->getMessage()}")
                ->redirect('/admin/classes');
        }
    }

    public function deleteEnrollment(Request $request, Response $response): void
    {
        $classId = $request->get('class_id');
        $enrollmentId = $request->get('enrollment_id');

        try {
            (new EnrollmentsModel())->delete($enrollmentId);
            $response->flash('success', 'Matrícula excluída com sucesso')
                ->redirect("/admin/classes/form?id=$classId");
        } catch (\Throwable $th) {
            $response->flash('error', "Não foi possível excluir a matrícula. {$th->getMessage()}")
                ->redirect("/admin/classes/form?id=$classId");;
        }
    }

    public function enroll(Request $request, Response $response): void
    {
        EnrollmentsValidation::validate($request);

        $studentId = $request->get('student_id');
        $classId = $request->get('class_id');

        (new EnrollmentsModel())->create([
            'student_id' => $studentId,
            'class_id' => $classId,
        ]);

        $response->flash('success', 'Matrícula realizada com sucesso')
            ->redirect("/admin/classes/form?id=$classId");
    }
}