<?php

namespace App\Shared\Http;

use App\Shared\Exceptions\ViewNotFoundException;

class Response
{
    private int $statusCode = 200;

    public function status(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }


    public function view(string $path, array $data = []): void
    {

        try {
            http_response_code($this->statusCode);
            (new View())->render($path, $data);
        } catch (ViewNotFoundException $e) {
            http_response_code(500);
            (new View())->renderError('errors/server-error', $data);
        }

    }
}