<?php

namespace App\Domain\Students;

use App\Domain\Enrollments\EnrollmentsValidation;
use App\Shared\Interfaces\HasMiddlewareInterface;
use App\Domain\Enrollments\EnrollmentsModel;
use App\Shared\Http\{Request, Response};
use App\Domain\Classes\ClassesModel;
use App\Shared\Http\AuthMiddleware;

class StudentsController implements HasMiddlewareInterface
{

    public function middlewares(): array
    {
        return [AuthMiddleware::class];
    }

    public function index(Request $request, Response $response): void
    {
        $page = (int)$request->get('page') ?: 1;

        if ($page < 1) $response->redirect('/admin/students');

        $search = $request->get('search', '');

        $response->view('students/index', [
            'students' => (new StudentsModel())->paginateWithEnrollmentsCount($page, 10, $search)
        ]);
    }

    public function create(Request $request, Response $response): void
    {

        StudentsValidation::validate($request);

        (new StudentsModel())->create([
            'name' => $request->get('nome'),
            'email' => $request->get('email'),
            'cpf' => $request->get('cpf'),
            'birth_date' => $request->get('data_de_nascimento'),
            'password' => password_hash($request->get('password'), PASSWORD_BCRYPT),
        ]);

        $response->flash('success', 'Aluno criado com sucesso')
            ->redirect('/admin/students');
    }

    public function form(Request $request, Response $response): void
    {
        $studentId = $request->get('id');

        $student = (new StudentsModel())->findBy('id', $studentId);
        $enrollments = (new EnrollmentsModel())->getByStudent($studentId);
        $classes = (new ClassesModel())->get(
            'SELECT *',
            'WHERE classes.id NOT IN (SELECT class_id FROM enrollments WHERE student_id = :student_id)',
            '',
            'ORDER BY classes.name',
            ['student_id' => $studentId]
        );

        $response->view('students/form', compact('student', 'enrollments', 'classes'));
    }

    public function update(Request $request, Response $response): void
    {

        StudentsValidation::validate($request);

        $data = [
            'name' => $request->get('nome'),
            'email' => $request->get('email'),
            'cpf' => $request->get('cpf'),
            'birth_date' => $request->get('data_de_nascimento'),
        ];

        $id = $request->get('id');
        $password = $request->get('senha');

        if ($password) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        (new StudentsModel())->update($id, $data);

        $response->flash('success', 'Aluno atualizado com sucesso')
            ->redirect("/admin/students/form?id=$id");
    }

    public function delete(Request $request, Response $response): void
    {
        try {
            (new StudentsModel())->delete($request->get('id'));
            $response->flash('success', 'Aluno excluído com sucesso')
                ->redirect('/admin/students');
        } catch (\Throwable $th) {
            $response->flash('error', "Não foi possível excluir o aluno. {$th->getMessage()}")
                ->redirect('/admin/students');
        }
    }

    public function deleteEnrollment(Request $request, Response $response): void
    {
        $studentId = $request->get('student_id');
        $enrollmentId = $request->get('enrollment_id');;

        try {
            (new EnrollmentsModel())->delete($enrollmentId);
            $response->flash('success', 'Matrícula excluída com sucesso')
                ->redirect("/admin/students/form?id=$studentId");
        } catch (\Throwable $th) {
            $response->flash('error', "Não foi possível excluir a matrícula. {$th->getMessage()}")
                ->redirect("/admin/students/form?id=$studentId");;
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
            ->redirect("/admin/students/form?id=$studentId");
    }
}