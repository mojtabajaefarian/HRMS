<?php
declare(strict_types=1);
namespace App\Controllers;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Session;
use App\Models\User;

class AuthController extends Controller {
    public function login(): string {
        if (Auth::check()) $this->redirect('/dashboard');
        return $this->view('auth/login', [
            'title' => 'ورود',
            'flash' => Session::flash('error')
        ]);
    }

    public function doLogin(): string {
        $u = (new User())->findByUsername(trim($_POST['username'] ?? ''));
        if (!$u || !password_verify(trim($_POST['password'] ?? ''), $u['password_hash'])) {
            Session::flash('error', 'نام کاربری یا رمز عبور اشتباه است.');
            $this->redirect('/login');
        }
        unset($u['password_hash']);
        Auth::login($u);
        $this->redirect('/dashboard');
        return '';
    }

    public function logout(): string {
        Auth::logout();
        $this->redirect('/login');
        return '';
    }
}
