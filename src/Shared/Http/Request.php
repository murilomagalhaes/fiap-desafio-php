<?php

namespace App\Shared\Http;

class Request
{
    private function validateAndRefreshCsrfToken(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') return;

        if (isset($_POST['csrf-token']) && $_POST['csrf-token'] === Session::get('csrf-token')) {
            return;
        }

        Session::refreshSessionCsrfToken();

        (new Response())
            ->status(400)
            ->view('errors/bad-request', ['message' => "Token CSRF ausente ou inválido"]);

    }

    public function validate(array $rules): array
    {
        $filteredInput = filter_input_array(INPUT_POST, $rules);

        foreach ($rules as $key => $rule) {
            if (!empty($filteredInput[$key])) {
                $filteredInput[$key] = htmlspecialchars($filteredInput[$key]);
            }
        }

        return $filteredInput;
    }


    public function get(string $key, $default = null): ?string
    {
        $this->validateAndRefreshCsrfToken();

        $value = $_POST[$key] ?? $_GET[$key] ?? null;

        if (!$value) return $default;

        return trim(htmlspecialchars($value));
    }

}