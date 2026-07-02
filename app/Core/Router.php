<?php
declare(strict_types=1);
namespace App\Core;
class Router {
    private array $routes = [];
    public function __construct(array $routes = []) { $this->routes = $routes; }
    public function dispatch(string $method, string $uri): void {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        if (!isset($this->routes[$method][$path])) {
            http_response_code(404);
            echo View::render('errors/404', ['title' => '404']);
            return;
        }
        [$controllerClass, $action] = $this->routes[$method][$path];
        $controller = new $controllerClass();
        echo $controller->$action();
    }
}
