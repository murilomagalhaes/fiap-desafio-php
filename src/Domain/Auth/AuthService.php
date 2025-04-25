<?php

namespace App\Domain\Auth;

use App\Domain\Staff\StaffModel;
use App\Shared\Http\Session;

class AuthService
{
    private Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function check(): bool
    {
        return (bool)$this->session->get('user');
    }

    public function getLoggedInUser(): ?\stdClass
    {
        return $_SESSION['user'] = null;
    }

    public function attemptLogIn(string $email, string $password): bool
    {
        $staff = new StaffModel();

        $user = $staff->findByEmail($email);

        $validPassword = $user && password_verify($password, $user->password);

        if ($validPassword) {
            $_SESSION['user'] = $user;
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        session_destroy();
    }
}