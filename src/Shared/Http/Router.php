<?php

namespace App\Shared\Http;

use App\Shared\Interfaces\HasMiddlewareInterface;
use App\Domain\Auth\AuthService;

class Router
{

    private array $routes = [];

    public function add(string $uri, string $method, array $action): void
    {
        $this->routes[$method][trim($uri, '/')] = $action;
    }


    public function run(): void
    {
        $path = parse_url(trim($_SERVER['REQUEST_URI'], '/'))['path'];
        $method = $_SERVER['REQUEST_METHOD'];

        $authService = new AuthService();
        $response = new Response();

        if ($authService->check() && $method === 'GET' && in_array($path, ['login', ''])) {
            $response->redirect('/admin/dashboard');
        }

        if (!$authService->check() && $method === 'GET' && !$path) {
            $response->redirect('login');
        }

        $action = $this->routes[$method][$path] ?? ['', ''];

        [$class, $classMethod] = $action;

        if (!class_exists($class) || !method_exists($class, $classMethod)) {
            $response->status(404)->view('errors/not-found');
        }

        $controller = new $class();

        if (in_array(HasMiddlewareInterface::class, class_implements($controller))) {
            foreach ($controller->middlewares() as $middleware) {
                $middleware = new $middleware();
                $middleware->handle(new Request(), new Response());
            };
        }

        $controller->$classMethod(new Request(), new Response());

    }


}