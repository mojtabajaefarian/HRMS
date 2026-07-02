<?php
declare(strict_types=1);
namespace App\Core;

class Router {
    private array $routes;
    public function __construct(array $routes) { $this->routes = $routes; }

    public function dispatch(string $method, string $uri): void {
        $base = app_config('base_url', '/HRMS/public');
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';
        if (str_starts_with(strtolower($path), strtolower($base))) {
            $path = substr($path, strlen($base));
        }
        if ($path === '' || $path === false) $path = '/';

        $route = $this->routes[$method][$path] ?? null;
        $params = [];
        if (!$route && isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $pattern => $handler) {
                if (strpos($pattern, '{') === false) continue;
                $regex = preg_replace('/\{[^\/]+\}/', '([^/]+)', $pattern);
                $regex = '#^' . $regex . '$#';
                if (preg_match($regex, $path, $m)) {
                    array_shift($m);
                    $params = array_map(fn($v) => ctype_digit((string)$v) ? (int)$v : $v, $m);
                    $route = $handler;
                    break;
                }
            }
        }

        if (!$route) {
            http_response_code(404);
            echo View::render('errors/404', ['title' => '404', 'debug_path' => $path]);
            return;
        }

        [$controller, $action] = $route;
        $obj = new $controller();
        echo $obj->$action(...$params);
    }
}
