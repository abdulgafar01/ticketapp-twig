<?php
namespace Hacker\TicketappTwig\Auth;

class Auth
{
    public static function check(): bool
    {
        return isset($_SESSION['user']);
    }

    public static function login(string $email, string $password): bool
    {
        // Fake validation for demo (replace with real DB check later)
        if ($email === 'admin@example.com' && $password === 'password') {
            $_SESSION['user'] = [
                'email' => $email,
                'name' => 'Admin User'
            ];
            return true;
        }
        return false;
    }

    public static function logout(): void
    {
        unset($_SESSION['user']);
    }
}
