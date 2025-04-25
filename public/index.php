<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\Auth\AuthController;
use App\Domain\DashboardController;
use App\Shared\Http\Router;

session_start();
$_SESSION['csrf-token'] = md5(uniqid());

$router = new Router();

// Public Routes
$router->add('/login', 'GET', [AuthController::class, 'login']);
$router->add('/login', 'POST', [AuthController::class, 'attempt']);
$router->add('/logout', 'DELETE', [AuthController::class, 'logout']);

// Protected Routes
$router->add('/admin/dashboard', 'GET', [DashboardController::class, 'index']);




$router->run();