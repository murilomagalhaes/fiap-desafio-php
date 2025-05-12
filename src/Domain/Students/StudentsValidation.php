<?php

namespace App\Domain\Students;

use App\Shared\Http\{Request, Response, Session};

class StudentsValidation
{
    public static function validateCPF(?string $cpf = null): bool
    {
        if (!$cpf) return false;

        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        if (strlen($cpf) !== 11) return false;

        if (preg_match('/(\d)\1{10}/', $cpf)) return false;

        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                // @phpstan-ignore-next-line
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

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

        $validEmail = $request->validate(['email' => FILTER_VALIDATE_EMAIL])['email'] ?? false;

        if (!$validEmail) {
            $errors[] = 'Digite um email válido';
        }

        if (strlen($name) < 3) {
            $errors[] = 'O nome deve conter ao menos 3 caracteres';
        }

        try {
            $birthDateObj = new \DateTime($birth_date);
            $twelveYearsAgo = new \DateTime('-12 years');

            if ($birthDateObj > $twelveYearsAgo) {
                $errors[] = 'O estudante deve ter mais de 12 anos';
            }

        } catch (\Exception $e) {
            $errors[] = 'A data de nascimento informada é inválida';
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

        if (!$id && !$password) {
            $errors[] = 'Digite uma senha';
        }

        if ($password) {

            if (strlen($password) < 8) {
                $errors[] = 'A senha deve conter ao menos 8 caracteres';
            }
            if (!preg_match('/[A-Z]/', $password)) {
                $errors[] = 'A senha deve conter ao menos uma letra maiúscula';
            }

            if (!preg_match('/[a-z]/', $password)) {
                $errors[] = 'A senha deve conter ao menos uma letra minúscula';
            }

            if (!preg_match('/[\W_]/', $password)) {
                $errors[] = 'A senha deve conter ao menos um caractere especial';
            }

        }


        if (!self::validateCPF($cpf)) {
            $errors[] = 'O CPF informado é inválido';
        }

        if (empty($errors)) return;

        Session::setFlash('errors', $errors);

        Session::setFlash('old', (object)[
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'cpf' => $cpf,
            'birth_date' => $birth_date,
        ]);

        $idParam = "";

        if ($id) $idParam = "?id=$id";

        $response->redirect("/admin/students/form$idParam");


    }
}