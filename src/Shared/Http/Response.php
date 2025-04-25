<?php

namespace App\Shared\Http;

use App\Shared\Exceptions\ViewNotFoundException;

class Response
{
    private int $statusCode = 200;

    private Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }

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

    public function redirect(string $to, array $flash = []): void
    {
        if ($flash) {
            $this->session->setFlash($flash);
        }

        http_response_code($this->statusCode);
        header("Location: $to");

        die();
    }
}