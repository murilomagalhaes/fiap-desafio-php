<?php

namespace App\Domain\Auth;

use App\Shared\Http\Response;
use App\Shared\Http\Request;

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login(Request $request, Response $response): void
    {
        $_SESSION['csrf-token'] = md5(uniqid());

        $response->view('auth/login');
    }

    public function attempt(Request $request, Response $response): void
    {
        $loggedIn = $this->authService->attemptLogIn(
            $request->get('email'),
            $request->get('password')
        );

        if ($loggedIn) {

            $response->status(302)->redirect('/admin/dashboard', ['message' => 'Logged in successfully']);
        }

        $response->status(302)->redirect('/login');
    }

    public function logout(Request $request, Response $response): void
    {
        $this->authService->logout();

        $response->status(302)->redirect('/login');
    }
}