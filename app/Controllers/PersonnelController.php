<?php
declare(strict_types=1);
namespace App\Controllers;
use App\Core\Controller;
class PersonnelController extends Controller {
    public function index(): string {
        $rows = [
            ['id' => 1, 'full_name' => 'نمونه کاربر ۱', 'team' => 'فروش', 'status' => 'ناقص'],
            ['id' => 2, 'full_name' => 'نمونه کاربر ۲', 'team' => 'پشتیبانی', 'status' => 'تکمیل'],
        ];
        return $this->view('personnel/index', ['title' => 'پرسنل', 'rows' => $rows]);
    }
}
