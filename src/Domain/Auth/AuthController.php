<?php

namespace App\Domain\Auth;

use App\Shared\Http\Response;
use App\Shared\Http\Request;

class AuthController
{
    public function login(Request $request, Response $response): void
    {
        $response->view('auth/login');
    }

    public function attempt(Request $request, Response $response): void
    {
        var_dump($_POST);
    }
}