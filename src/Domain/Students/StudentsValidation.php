<?php

namespace App\Domain\Students;

use App\Shared\Http\{Request, Response, Session};

class StudentsValidation
{
    public static function validate(Request $request): void
    {

        $id = $request->get('id');
        $name = $request->get('nome', '');
        $email = $request->get('email', '');
        $cpf = $request->get('cpf');
        $birth_date = $request->get('data_de_nascimento');
        $password = $request->get('senha', '');

        $response = new Response();
        $students = new StudentsModel();

        $errors = [];

        if (!empty($request->validate(['email' => FILTER_VALIDATE_EMAIL])['email'])) {
            $errors[] = 'Digite um email válido';
        }

        if (strlen($name) < 3) {
            $errors[] = 'O nome deve conter ao menos 3 caracteres';
        }

        try {
            new \DateTime($birth_date);
        } catch (\Exception $e) {
            $errors[] = 'A descrição deve conter ao menos 3 caracteres';
        }

        if (!$id) {
            if ($students->count('WHERE email = :email', compact('email'))) {
                $errors[] = 'Já existe um estudante com este e-mail';
            }

            if ($students->count('WHERE cpf = :cpf', compact('cpf'))) {
                $errors[] = 'Já existe um estudante com este CPF';
            }
        }

        if ($students->count('WHERE email = :email and id <> :id', compact('email', 'id'))) {
            $errors[] = 'Já existe um estudante com este e-mail';
        }

        if ($students->count('WHERE cpf = :cpf and id <> :id', compact('cpf', 'id'))) {
            $errors[] = 'Já existe um estudante com este CPF';
        }


        if (
            (!$id && (strlen($password) < 8))
            || $id && ($password && strlen($password) < 8)
        ) {
            $errors[] = 'A senha deve conter ao menos 8 caracteres';
        }

        if (empty($errors)) return;

        Session::setFlash('errors', $errors);

        $response->view(
            'students/form',
            ['student' => (object)compact('id', 'name', 'email', 'cpf', 'birth_date')]
        );


    }
}