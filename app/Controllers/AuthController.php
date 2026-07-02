<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
class AuthController extends Controller {
    public function login(): string {
        return $this->view('auth/login', ['title' => 'ورود به HRMS']);
    }
}
