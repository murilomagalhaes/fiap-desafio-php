<?php

namespace App\Shared\Http;

use App\Shared\Exceptions\ViewNotFoundException;

class Response
{
    private int $statusCode;


    public function status(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }


    public function view(string $path, array $data = []): void
    {
        try {
            if (isset($this->statusCode)) http_response_code($this->statusCode);
            (new View())->render($path, $data);
        } catch (ViewNotFoundException $e) {
            $this->status(500)->view('errors/server-error', ['message' => $e->getMessage()]);

        }

    }

    public function flash(string $key, $value): self
    {
        Session::setFlash($key, $value);

        return $this;
    }

    public function redirect(string $to): void
    {
        http_response_code(302);
        header("Location: $to");

        die();
    }

}