<?php
declare(strict_types=1);
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\PersonnelController;
return [
    'GET' => [
        '/'          => [AuthController::class, 'login'],
        '/login'     => [AuthController::class, 'login'],
        '/dashboard' => [DashboardController::class, 'index'],
        '/personnel' => [PersonnelController::class, 'index'],
    ],
];
