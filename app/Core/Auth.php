<?php
declare(strict_types=1);
namespace App\Core;

class Auth {
    public static function check(): bool { return Session::has('user'); }
    public static function user(): ?array { return Session::get('user'); }
    public static function login(array $u): void { Session::set('user', $u); }
    public static function logout(): void { Session::remove('user'); }
    public static function requireLogin(): void {
        if (!self::check()) {
            header('Location: ' . app_config('base_url') . '/login');
            exit;
        }
    }
}
