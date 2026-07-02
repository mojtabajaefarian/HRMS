<?php
declare(strict_types=1);

require_once __DIR__ . '/../bootstrap/app.php';

$routes = require BASE_PATH . '/routes/web.php';
$router = new App\Core\Router($routes);
$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');
