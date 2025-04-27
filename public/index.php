<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\Dashboard\DashboardController;
use App\Domain\Students\StudentsController;
use App\Domain\Classes\ClassesController;
use App\Domain\Auth\AuthController;
use App\Shared\Http\Session;
use App\Shared\Http\Router;

Session::start();

$router = new Router();

// Auth
$router->add('login', 'GET', [AuthController::class, 'login']);
$router->add('login', 'POST', [AuthController::class, 'attempt']);
$router->add('logout', 'POST', [AuthController::class, 'logout']);

// Dashboard
$router->add('admin/dashboard', 'GET', [DashboardController::class, 'index']);

// Classes
$router->add('admin/classes', 'GET', [ClassesController::class, 'index']);
$router->add('admin/classes/form', 'GET', [ClassesController::class, 'form']);
$router->add('admin/classes/create', 'POST', [ClassesController::class, 'create']);
$router->add('admin/classes/update', 'POST', [ClassesController::class, 'update']);
$router->add('admin/classes/delete', 'POST', [ClassesController::class, 'delete']);
$router->add('admin/classes/delete-enrollment', 'POST', [ClassesController::class, 'deleteEnrollment']);
$router->add('admin/classes/enroll', 'POST', [ClassesController::class, 'enroll']);

// Students
$router->add('admin/students', 'GET', [StudentsController::class, 'index']);
$router->add('admin/students/form', 'GET', [StudentsController::class, 'form']);
$router->add('admin/students/create', 'POST', [StudentsController::class, 'create']);
$router->add('admin/students/update', 'POST', [StudentsController::class, 'update']);
$router->add('admin/students/delete', 'POST', [StudentsController::class, 'delete']);
$router->add('admin/students/delete-enrollment', 'POST', [StudentsController::class, 'deleteEnrollment']);
$router->add('admin/students/enroll', 'POST', [StudentsController::class, 'enroll']);

$router->run();