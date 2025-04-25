<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\Dashboard\DashboardController;
use App\Domain\Auth\AuthController;
use App\Shared\Http\Session;
use App\Shared\Http\Router;

(new Session())->start();

$router = new Router();

// Public Routes
$router->add('/login', 'GET', [AuthController::class, 'login']);
$router->add('/login', 'POST', [AuthController::class, 'attempt']);
$router->add('/logout', 'POST', [AuthController::class, 'logout']);

// Protected Routes
$router->add('/admin/dashboard', 'GET', [DashboardController::class, 'index']);

$router->run();