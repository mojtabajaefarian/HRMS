<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
class DashboardController extends Controller {
    public function index(): string {
        return $this->view('dashboard/index', ['title' => 'داشبورد']);
    }
}
