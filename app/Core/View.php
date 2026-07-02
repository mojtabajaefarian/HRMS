<?php
declare(strict_types=1);
namespace App\Core;
class View {
    public static function render(string $view, array $data = []): string {
        $viewFile = __DIR__ . '/../Views/' . $view . '.php';
        if (!file_exists($viewFile)) return 'View not found: ' . htmlspecialchars($view);
        extract($data, EXTR_SKIP);
        ob_start();
        require $viewFile;
        return ob_get_clean();
    }
}
