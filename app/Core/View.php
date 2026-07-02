<?php
declare(strict_types=1);
namespace App\Core;

class View {
    public static function render(string $view, array $data = []): string {
        extract($data, EXTR_SKIP);
        $f = BASE_PATH . '/app/Views/' . $view . '.php';
        ob_start();
        require $f;
        return (string) ob_get_clean();
    }
}
