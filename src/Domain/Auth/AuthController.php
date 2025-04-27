<?php

namespace App\Domain\Auth;

use App\Shared\Http\{Request, Response};

class AuthController
{
    private AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function login(Request $request, Response $response): void
    {
        $response->view('auth/login');
    }

    public function attempt(Request $request, Response $response): void
    {
        $validEmail = $request->validate(['email' => FILTER_VALIDATE_EMAIL])['email'] ?? false;

        $password = $request->get('password');

        if (!$password) {
            $response->flash('error', 'Digite sua senha')
                ->redirect('/login');
        }

        if (!$validEmail) {
            $response->flash('error', 'Digite um email válido')
                ->redirect('/login');
        }

        $loggedIn = $this->authService->attemptLogIn(
            $request->get('email'),
            $request->get('password')
        );

        if ($loggedIn) {
            $response->status(302)->redirect('/admin/dashboard');
        }

        $response->flash('error', 'Credenciais inválidas')
            ->redirect('/login');
    }

    public function logout(Request $request, Response $response): void
    {
        $this->authService->logout();

        $response->redirect('/login');
    }
}