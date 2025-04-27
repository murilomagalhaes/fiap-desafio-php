<?php

namespace App\Shared\Http;

use App\Shared\Interfaces\MiddlewareInterface;
use App\Domain\Auth\AuthService;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, Response $response): void
    {
        $authService = new AuthService();

        if (!$authService->check()) {
            $response->status(403)->view('errors/forbidden');;
        }
    }
}