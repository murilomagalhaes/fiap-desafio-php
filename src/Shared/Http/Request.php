<?php

namespace App\Shared\Http;

class Request
{
    private function validateAndRefreshCsrfToken(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') return;

        if (isset($_POST['csrf-token']) && $_POST['csrf-token'] === $_SESSION['csrf-token']) {
            return;
        }

        http_response_code(400);
        (new Session())->refreshSessionCsrfToken();
        (new View())->renderError('errors/bad-request', ['message' => "Token CSRF ausente ou inválido"]);;
        die();

    }

    public function query(string $key)
    {
        return $_GET[$key] ?? null;
    }

    public function get(string $key)
    {
        $this->validateAndRefreshCsrfToken();

        return $_POST[$key] ?? null;
    }
}