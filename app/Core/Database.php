<?php
declare(strict_types=1);

namespace App\Core;
use PDO;

class Database {
    private static ?PDO $pdo = null;

    public static function connection(): PDO {
        if (self::$pdo) return self::$pdo;

        $c = $GLOBALS['config_db'] ?? [];
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            $c['host'] ?? '127.0.0.1',
            $c['port'] ?? '3306',
            $c['database'] ?? '',
            $c['charset'] ?? 'utf8mb4'
        );

        self::$pdo = new PDO($dsn, $c['username'] ?? '', $c['password'] ?? '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);

        return self::$pdo;
    }
}
