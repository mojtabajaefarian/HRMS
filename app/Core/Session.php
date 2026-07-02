<?php
declare(strict_types=1);
namespace App\Core;

class Session {
    public static function set(string $k, $v): void { $_SESSION[$k] = $v; }
    public static function get(string $k, $d = null) { return $_SESSION[$k] ?? $d; }
    public static function has(string $k): bool { return array_key_exists($k, $_SESSION); }
    public static function remove(string $k): void { unset($_SESSION[$k]); }
    public static function flash(string $k, ?string $v = null): ?string {
        if ($v !== null) { $_SESSION['_flash'][$k] = $v; return null; }
        $m = $_SESSION['_flash'][$k] ?? null;
        unset($_SESSION['_flash'][$k]);
        return $m;
    }
}
