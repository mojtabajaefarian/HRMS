<?php
declare(strict_types=1);
define('APP_NAME', 'HRMS Web');
define('APP_ENV', 'local');
define('APP_DEBUG', true);
define('APP_URL', 'http://localhost');
define('APP_TIMEZONE', 'Asia/Tehran');
date_default_timezone_set(APP_TIMEZONE);
spl_autoload_register(function ($class) {
    $prefix = 'App\\';
    $baseDir = __DIR__ . '/../app/';
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) return;
    $relativeClass = substr($class, strlen($prefix));
    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';
    if (file_exists($file)) require_once $file;
});
