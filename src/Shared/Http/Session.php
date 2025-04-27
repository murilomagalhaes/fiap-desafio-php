<?php

namespace App\Shared\Http;

class Session
{
    public static function start(): void
    {
        session_start();

        if (!isset($_SESSION['csrf-token'])) {
            $_SESSION['csrf-token'] = md5(uniqid('csrf:', true));
        }

    }

    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function hasFlash(string $key): bool
    {
        return isset($_SESSION['flash'][$key]);
    }

    public static function setFlash(string $key, $value): void
    {
        $_SESSION['flash'][$key] = $value;
    }

    public static function getFlash(string $key)
    {
        $data = $_SESSION['flash'][$key] ?? null;

        if ($data) unset($_SESSION['flash'][$key]);

        return $data;
    }

    public static function delete($key): void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(): bool
    {
        return session_destroy();
    }

    public static function refreshSessionCsrfToken(): void
    {
        $_SESSION['csrf-token'] = md5(uniqid('csrf:', true));
    }
}