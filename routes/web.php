<?php
declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\PersonnelController;

return [
    'GET' => [
        '/' => [AuthController::class, 'login'],
        '/login' => [AuthController::class, 'login'],
        '/logout' => [AuthController::class, 'logout'],
        '/dashboard' => [DashboardController::class, 'index'],

        '/personnel' => [PersonnelController::class, 'index'],
        '/personnel/create' => [PersonnelController::class, 'create'],
        '/personnel/{id}' => [PersonnelController::class, 'show'],
    ],
    'POST' => [
        '/login' => [AuthController::class, 'doLogin'],
        '/personnel/store' => [PersonnelController::class, 'store'],
        '/personnel/{id}/deficiencies/store' => [PersonnelController::class, 'addDeficiency'],
        '/personnel/{id}/followups/store' => [PersonnelController::class, 'addFollowup'],
        '/personnel/{id}/actions/store' => [PersonnelController::class, 'addAction'],
        '/personnel/{id}/positions/save' => [PersonnelController::class, 'savePositions'],
    ],
];
