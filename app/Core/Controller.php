<?php
declare(strict_types=1);
namespace App\Core;

abstract class Controller {
    protected function view(string $v, array $d = []): string { return View::render($v, $d); }
    protected function redirect(string $p): void {
        header('Location: ' . app_config('base_url') . $p);
        exit;
    }
}
