<?php

namespace App\Domain\Dashboard;

use App\Shared\Interfaces\HasMiddlewareInterface;
use App\Domain\Enrollments\EnrollmentsModel;
use App\Domain\Students\StudentsModel;
use App\Domain\Classes\ClassesModel;
use App\Shared\Http\AuthMiddleware;
use App\Shared\Http\Response;
use App\Shared\Http\Request;


class DashboardController implements HasMiddlewareInterface
{
    public function middlewares(): array
    {
        return [AuthMiddleware::class];
    }

    public function index(Request $request, Response $response): void
    {
        $classes = new ClassesModel();
        $students = new StudentsModel();
        $enrollments = new EnrollmentsModel();

        $response->view('dashboard/index', [
            'classes_count' => $classes->count(),
            'students_count' => $students->count(),
            'enrollments_count' => $enrollments->count()
        ]);
    }

}