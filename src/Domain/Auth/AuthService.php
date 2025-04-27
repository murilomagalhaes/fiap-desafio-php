<?php

namespace App\Domain\Auth;

use App\Domain\Staff\StaffModel;
use App\Shared\Http\Session;

class AuthService
{

    public function check(): bool
    {
        return (bool)Session::get('user');
    }

    public function getLoggedInUser(): ?\stdClass
    {
        return Session::get('user');
    }

    public function attemptLogIn(string $email, string $password): bool
    {
        $staff = new StaffModel();

        $user = $staff->findBy('email', $email);

        $validPassword = $user && password_verify($password, $user->password);

        if ($validPassword) {
            Session::set('user', $user);
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        Session::destroy();
    }
}