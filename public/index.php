<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Domain\Auth\AuthController;
use App\Shared\Http\Router;

session_start();
$_SESSION['csrf-token'] = md5(uniqid());

$router = new Router();

$router->add('/login', 'GET', [AuthController::class, 'login']);
$router->add('/login', 'POST', [AuthController::class, 'attempt']);
$router->add('/logout', 'DELETE', [AuthController::class, 'logout']);

//$router->middleware(AuthMiddleware::class, [
//    ['uri' => '/dashboard', 'method' => 'GET', [DashboardController::class, 'index']]
//]);

$router->run();