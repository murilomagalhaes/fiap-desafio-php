<?php

namespace App\Domain\Classes;

use App\Shared\Http\{Request, Response, Session};

class ClassesValidation
{
    public static function validate(Request $request): void
    {
        $id = $request->get('id');
        $name = $request->get('nome') ?? '';
        $description = $request->get('descricao') ?? '';

        $response = new Response();
        $classes = new ClassesModel();

        $errors = [];

        if (strlen($name) < 3) {
            $errors[] = 'O nome deve conter ao menos 3 caracteres';
        }

        if (strlen($description) < 3) {
            $errors[] = 'A descrição deve conter ao menos 3 caracteres';
        }

        if (!$id && $classes->count('WHERE name = :name', compact('name'))) {
            $errors[] = 'Já existe uma turma com esse nome';
        }

        if ($classes->count('WHERE name = :name and id <> :id', compact('name', 'id'))) {
            $errors[] = 'Já existe uma turma com esse nome';
        }

        if (empty($errors)) return;

        Session::setFlash('errors', $errors);

        Session::setFlash('old', (object)[
            'id' => $id,
            'name' => $name,
            'description' => $description,
        ]);

        $idParam = "";

        if ($id) $idParam = "?id=$id";

        $response->redirect("/admin/classes/form$idParam");

    }
}