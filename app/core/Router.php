<?php

class Router
{
    private array $routes = [];

    public function get(string $route, string $action): void
    {
        $this->routes['GET'][trim($route, '/')] = $action;
    }

    public function post(string $route, string $action): void
    {
        $this->routes['POST'][trim($route, '/')] = $action;
    }

    public function dispatch()
{
    $url = trim($_GET['url'] ?? '', '/');
    $method = $_SERVER['REQUEST_METHOD'];

    $found = false;
    foreach ($this->routes[$method] as $route => $action) {
        $pattern = preg_replace('/\{[a-zA-Z_]+\}/', '([a-zA-Z0-9]+)', $route);
        if (preg_match('#^' . $pattern . '$#', $url, $matches)) {
            $found = true;
            array_shift($matches); // hapus full match
            [$controller, $methodName] = explode('@', $action);
            require_once "../app/controllers/$controller.php";
            (new $controller)->$methodName(...$matches);
            break;
        }
    }

    if (!$found) {
        http_response_code(404);
        echo "ROUTE TIDAK DITEMUKAN: $url";
        exit;
    }
}


    private function match(string $route, string $url): array|false
    {
        $routeParts = explode('/', $route);
        $urlParts   = explode('/', $url);

        if (count($routeParts) !== count($urlParts)) {
            return false;
        }

        $params = [];

        foreach ($routeParts as $i => $part) {
            if (preg_match('/^{.+}$/', $part)) {
                $params[] = $urlParts[$i];
            } elseif ($part !== $urlParts[$i]) {
                return false;
            }
        }

        return $params;
    }

    private function notFound(string $url): void
    {
        http_response_code(404);
        echo "ROUTE TIDAK DITEMUKAN: $url";
        exit;
    }
}
