<?php

namespace App\Shared\Http;

class Session
{
    public function start(): void
    {
        session_start();

        if (!isset($_SESSION['csrf-token'])) {
            $_SESSION['csrf-token'] = md5(uniqid('csrf:', 'true'));
        }

    }

    public function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public function setFlash(array $data)
    {
        $this->set('flash', $data);;
    }

    public function getFlash(): ?array
    {
        $data = $_SESSION['flash'];

        if ($data) {
            $this->delete('flash');
        }

        return $data;
    }

    public function delete($key): void
    {
        unset($_SESSION[$key]);
    }

    public function destroy(): bool
    {
        return session_destroy();
    }

    public function refreshSessionCsrfToken(): void
    {
        $_SESSION['csrf-token'] = md5(uniqid('csrf:', 'true'));
    }
}