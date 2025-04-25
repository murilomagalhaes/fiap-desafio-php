<?php

namespace App\Shared\Http;

use App\Shared\Interfaces\HasMiddlewareInterface;

class Router
{
    private array $routes = [];

    public function add(string $uri, string $method, array $action): void
    {
        $this->routes[$method][trim($uri, '/')] = $action;
    }

    public function middleware(string $middleware, array $routes = [])
    {
        foreach ($routes as $route) {
            $route['action'][] = $middleware;
            $this->add($route['uri'], $route['method'], $route['action']);
        }
    }

    public function run(): void
    {
        $uri = trim($_SERVER['REQUEST_URI'], '/');
        $method = $_SERVER['REQUEST_METHOD'];

        $action = $this->routes[$method][$uri] ?? null;

        if (!$action || !class_exists($action[0]) || !method_exists($action[0], $action[1])) {
            http_response_code(404);
            (new Response())->view('errors/not-found');
            return;
        }

        [$class, $classMethod] = $action;

        $controller = new $class();

        if (class_implements($controller, HasMiddlewareInterface::class)) {
            foreach ($controller->middlewares() as $middleware) {
                $middleware = new $middleware();
                $middleware->handle();
            };
        }

        $controller->$classMethod(new Request(), new Response());


    }


}