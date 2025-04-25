<?php

namespace App\Shared\Http;

use App\Shared\Interfaces\MiddlewareInterface;
use App\Domain\Auth\AuthService;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(): void
    {
        $authService = new AuthService();

        if(!$authService->check()){
            http_response_code(403);
            (new Response())->view('errors/forbidden');
            die();
        }
    }
}