<?php
declare(strict_types=1);

session_start();
define('BASE_PATH', dirname(__DIR__));

spl_autoload_register(function($class){
    $prefix = 'App\\';
    if (strncmp($prefix, $class, strlen($prefix)) !== 0) return;
    $relative = substr($class, strlen($prefix));
    $file = BASE_PATH . '/app/' . str_replace('\\', '/', $relative) . '.php';
    if (file_exists($file)) require_once $file;
});

$GLOBALS['config_app'] = require BASE_PATH . '/config/app.php';
$GLOBALS['config_db']  = require BASE_PATH . '/config/database.php';

function app_config(string $key, $default = null) {
    return $GLOBALS['config_app'][$key] ?? $default;
}
function hrms_trace(string $message): void {
    $dir = BASE_PATH . '/storage/logs';
    if (!is_dir($dir)) @mkdir($dir, 0777, true);
    @file_put_contents($dir . '/trace.log', '['.date('Y-m-d H:i:s').'] '.$message.PHP_EOL, FILE_APPEND);
}
